<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Bookdetails extends Component
{
    public $book;
    
    public function render()
    {
        return view('livewire.bookdetails');
    }

    public function addToCart()
    {
       if(Auth::user()->books()->attach($this->book)){
            session()->flash('addedToCart', 'Book added to your cart');
       }
    }

    public function removeFromCart()
    {
        if(Auth::user()->books()->detach($this->book)){
            session()->flash('removedFromCart', 'Book removed from your cart');
       }
    }
}
