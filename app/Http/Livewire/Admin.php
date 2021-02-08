<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\User;
use App\Models\Order;
use Livewire\Component;
use App\Models\ToDoList;
use Illuminate\Support\Facades\Http;

class Admin extends Component
{
    public $completed = [];

    public function mount()
    {
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
}
