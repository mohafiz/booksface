<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Sales;
use Livewire\Component;

class AdminOrders extends Component
{
    public function render()
    {
        return view('livewire.admin-orders', [
            'orders' => Order::where('active', true)->get(),
        ]);
    }

    public function orderDone($id, $totalPrice)
    {        
        $attributes = [
            'sales' => $totalPrice,
            'Month' => Carbon::now()->format('F')
        ];
        
        if (Sales::create($attributes) ){
            Order::find($id)->update(['active' => false]);
        }
    }

    public function deleteOrder($id)
    {
        Order::find($id)->update(['active' => false]);
    }
}
