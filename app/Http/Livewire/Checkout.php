<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\Order;
use Auth;

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
        
        $status = array();

        foreach (Auth::user()->books()->get() as $book) {
            $bookQuantity = Auth::user()->books()->where('book_id', $book->id)->first()->pivot->amount;

            $orderInfo = [
                'user_id'        => $userId,
                'title'          => $book->title,
                'quantity'       => $bookQuantity,
                'BillingAddress' => $this->billingAddress,
                'TotalPrice'     => $this->totalPrice
            ];

            if (Order::create($orderInfo)) {
                array_push($status, true);
                Auth::user()->books()->detach($book);
                $book->update(['stock' => $book->stock-$orderInfo['quantity']]);

                if ($book->stock === 0) {
                    $book->delete();
                }
            }
        }

        if (!in_array(false, $status)) {
            session()->flash('OrderConfirmed', 'Your order has been submitted');
            return redirect(url('/list'));
        }

    }
}
