<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Auth;

class CartCount extends Component
{
    public $cartCount;

    protected $listeners = [
        'bookAdded' => 'increaseCartCount'
    ];

    public function render()
    {;

        return view('livewire.cart-count');
    }

    public function increaseCartCount()
    {
        $this->cartCount = Auth::user()->books()->count();
    }
}
