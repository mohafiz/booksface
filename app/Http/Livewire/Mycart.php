<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Book;
use Auth;

class Mycart extends Component
{
    public $userbooks;
    public $amount      = array();

    public function render()
    {
        return view('livewire.mycart');
    }

    public function mount()
    {
        foreach ($this->userbooks as $book) {
            $this->amount[$book->id] = Auth::user()->books()->where('book_id', $book->id)->first()->pivot->amount;
        }
    }

    public function updateAmount($id)
    {
        $book = Book::find($id);

        if ($this->amount[$id] > $book->stock) {
            session()->flash('greaterThanStock'.$id, 'The amount is greater than the available stock!');
        }
        else{
            Auth::user()->books()->updateExistingPivot($id, ['amount' => $this->amount[$id]]);
        }
    }
}
