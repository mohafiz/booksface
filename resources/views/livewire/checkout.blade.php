<div>
    <div class="content">
        <div class="container">
             <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-7 col-xs-12">
                    <div class="box">
                        <h3 class="box-title">Complete your order.</h3>
                        <h5 class="bok-title">Take a look at your order summary and confirm it's what you want, Enter your billing address if any and submit your order.</h5>
                        <form wire:submit.prevent.lazy="confirmOrder">
                            <div class="row">
                                <input type="text" name="billingAddress" wire:model="billingAddress" class="form-control" placeholder="Billing address (leave blank if the same as your shipping address)">
                            </div>
                        </form>
                        <br>
                        <button class="btn btn-primary" wire:click="confirmOrder" style="width: 100%">Submit Order</button>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-5 col-xs-12">  
                    <div class="widget">
                        <h4 class="widget-title">Order Summary</h4>
                            <div class="summary-block">
                                @foreach($userbooks as $book)
                                    <div class="summary-content">
                                        <div class="summary-head"><h5 class="summary-title">{{ $book->title }}</h5></div>
                                        <div class="summary-price">
                                            <p class="summary-text">{{ $book->price }}</p>
                                            <span class="summary-small-text pull-right">Quantity: {{ $book->pivot->amount }}</span>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="summary-content">
                                    <div class="summary-head"><h5 class="summary-title" style="color: green">Total Price</h5></div>
                                    <div class="summary-price">
                                        <p class="summary-text">{{ "$".$totalPrice }}</p>
                                    </div>
                                </div>
                            </div>                                
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>