<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\User;
use App\Models\Order;
use App\Models\Sales;
use Livewire\Component;
use App\Models\ToDoList;
use Illuminate\Support\Facades\Http;

class Admin extends Component
{
    public $completed   = [];
    public $salesChart  = [];
    public $ordersChart = [];
    public $toDo = [
        'name'   => '',
        'period' => '',
        'unit'   => '',
    ];

    protected $rules = [
        'toDo.name'   => 'required|min:6',
        'toDo.period' => 'required|numeric|gt:0',
        'toDo.unit'   => 'required'
    ];

    protected $validationAttributes = [
        'toDo.name'   => 'To-Do Name',
        'toDo.perion' => 'To-Do Period',
        'toDo.unit'   => 'To-Do Unit'
    ];

    public function updated($toDo)
    {
        $this->validateOnly($toDo);
    }

    public function mount()
    {
        $sales = Sales::groupBy('Month')
            ->selectRaw('Month, sum(sales) as sales')
            ->pluck('Month', 'sales');

        foreach ($sales as $sales => $month) {
            $this->salesChart[$month] = $sales;
        }

        $orders = Order::groupBy('month')
            ->selectRaw('month, count(*) as orders')
            ->pluck('month', 'orders');

        foreach ($orders as $orders => $month) {
            $this->ordersChart[$month] = $orders;
        }

        $completedStatus = ToDoList::select('id', 'completed')->get();
        
        foreach ($completedStatus as $item) {
            $this->completed[$item->id] = $item->completed;
        }
    }

    public function render()
    {
        return view('livewire.admin', [
            'orders' => Order::all()->count(),
            'books'  => Book::all()->count(),
            'users'  => User::all()->count(),
            'toDoList' => ToDoList::all(),
            'newusers' => User::where('created_at', '>', Carbon::now()->subdays(10))->count(),
        ]);
    }

    public function completed($id)
    {
        $item = ToDoList::find($id);
        $item->update(['completed' => $this->completed[$id]]);
    }

    public function addToDoItem()
    {
        $this->validate();

        if(ToDoList::create($this->toDo)){
            foreach ($this->toDo as $key => $value) {
                $this->toDo[$key] = '';
            }
        }
    }
}
