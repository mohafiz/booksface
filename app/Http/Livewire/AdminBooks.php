<?php

namespace App\Http\Livewire;

use App\Models\Book;
use Livewire\Component;

class AdminBooks extends Component
{
    public $stockAmount;

    public function render()
    {
        return view('livewire.admin-books', [
            'books' => Book::all(),
        ]);
    }

    public function addToStock($id)
    {
        $book = Book::find($id);
        $book->update(['stock' => $book->stock + $this->stockAmount]);
    }

    public function deleteBook($id)
    {
        Book::find($id)->delete();
    }
}
