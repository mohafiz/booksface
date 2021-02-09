<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class BooksController extends Controller
{
    public function index()
    {
    	return view('welcome');
    }

    public function booksList()
    {
    	return view('list');
    }

    public function addBooks()
    {
    	return view('add');
    }

    public function bookDetails($slug)
    {
        $book   = Book::where('slug', $slug)->first();
        return view('details', compact('book'));
    }

    public function myCart()
    {
        $userbooks = Auth::user()->books()->get();

        return view('mycart', compact('userbooks'));
    }

    public function checkout()
    {
        return view('checkout');
    }

    public function admin()
    {
        return view('admin.admin');
    }
}
