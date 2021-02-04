<?php

namespace App\Http\Livewire;

use Auth;
use Http;
use \App\Models\Book;
use Livewire\Component;
use App\Events\bookAdded;
use Livewire\WithPagination;

class Bookslist extends Component
{
	use WithPagination;

    public $book;

    public function render()
    {
        $books = Book::where('title', 'like', '%'.$this->book.'%')->orderBy('title')->paginate(9);

        return view('livewire.bookslist', [
        	'books'           => $books,
            'booksCount'      => Book::count(),
        ]);
    }

    public function addToCart($id)
    {
        $book = Book::find($id);
        Auth::user()->books()->attach($book);

        $this->emit('bookAdded');
    }
}
