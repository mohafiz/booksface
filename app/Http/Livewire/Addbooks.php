<?php

namespace App\Http\Livewire;

use Livewire\Component;
use \App\Models\Book;
use Http;
use Str;

class Addbooks extends Component
{
    public $searchTerm;

	protected $rules = [
		'searchTerm'	=> 'required|string'
	];

	protected $messages = [
		'searchTerm.required'	=> 'You didn\'t enter a search term !',
		'searchTerm.string'	=> 'Your input seems to be not a valid text',
	];

	protected $validationAttributes = [
		'searchTerm'	=> 'Term to search for'
    ];
    
    public function render()
    {
        return view('livewire.addbooks');
    }

    public function updated($searchTerm)
    {
    	$this->validateOnly($searchTerm);
    }

    public function addBooks()
    {
    	$this->validate();

		$searchBooks 		= Http::get('https://api.itbook.store/1.0/search/'.$this->searchTerm);
		$initBooks			= $searchBooks->json();

		
        $status = [];
        
    	foreach ($initBooks['books'] as $book) {

            if (Book::where('title', $book['title'])->exists()) {
                continue;
            }

			$bookDeatails = Http::get('https://api.itbook.store/1.0/books/'.$book['isbn13'])->json();

			$bookInfo = [
				'title'		=> $book['title'],
				'subtitle'	=> $book['subtitle'],
				'isbn13'	=> $book['isbn13'],
				'price'		=> $book['price'],
				'image'		=> $book['image'],
				'authors'	=> $bookDeatails['authors'],
				'publisher'	=> $bookDeatails['publisher'],
				'year'		=> $bookDeatails['year'],
				'desc'		=> $bookDeatails['desc'],
				'slug'		=> Str::slug($book['title']),
			];

			if (Book::create($bookInfo)) {
				array_push($status, true);
			}
			else{
				array_push($status, false);
			}
		}
		
		if (!in_array(false, $status)) {
			session()->flash('booksAdded', 'All related books added successfully');
			return back()->withInput();
		}

    }
}
