<?php

namespace App\Http\Livewire;

use Auth;
use Carbon\Carbon;
use App\Models\Order;
use Livewire\Component;
use Illuminate\Http\Request;

class Checkout extends Component
{
    public $totalPrice = 0;
    public $billingAddress;

    protected $rules = [
        'billingAddress' => 'nullable|min:6'
    ];

    protected $validationAttributes = [
        'billingAddress' => 'Billing Address'
    ];
    
    public function render(Request $request)
    {
        $userbooks = Auth::user()->books()->get();

        return view('livewire.checkout', [
            'userbooks' => $userbooks
        ]);
    }

    public function mount()
    {
        foreach (Auth::user()->books()->get() as $book) {
            $bookPrice  = explode("$", $book->price)[1];
            $bookAmount = $book->pivot->amount;

            $this->totalPrice += ($bookPrice*$bookAmount);
        }
    }

    public function confirmOrder()
    {
        $this->validate();
        $userId = Auth::user()->id;

        if ($this->billingAddress === null) {
            $this->billingAddress = Auth::user()->Address;
        }
        
        $orderInfo = [
            'user_id'        => $userId,
            'BillingAddress' => $this->billingAddress,
            'TotalPrice'     => $this->totalPrice,
            'month'          => Carbon::now()->format('F'),
        ];

        $books  = [];

        foreach (Auth::user()->books()->get() as $book) {
            $quantity = Auth::user()->books()->where('book_id', $book->id)->first()->pivot->amount;
            $books[$book->title] = $quantity;

            $orderInfo['books'] = $books;
        }

        if (Order::create($orderInfo)) {

            Auth::user()->books()->detach();
            $book->update(['stock' => $book->stock - $books[$book->title]]);

            if ($book->stock === 0) {
                $book->delete();
            }

            session()->flash('OrderConfirmed', 'Your order has been submitted');
            return redirect(url('/list'));
        }

    }
}
