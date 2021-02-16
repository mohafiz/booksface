<div>
    <div class="container mt-5">

        @if(count($userbooks) === 0)
            <div class="row">
                <b>No books in your cart.</b>
            </div>
        @else
            <div class="row">
                @foreach($userbooks as $book)
                    <div class="col-md-4">
                        <div class="card p-3">
                            <div class="d-flex flex-row"><img src="{{ $book->image }}"></div>
                                <div class="d-flex flex-column">
                                    <span>
                                        <b>
                                            <a href="{{ route('bookDetails', ['slug' => $book->slug]) }}">{{ $book->title }}</a>
                                        </b>
                                        <p>{{ $book->subtitle }}</p>
                                    </span>
                                    <span>
                                        <p><b>Price:</b> {{ $book->price }}</p>
                                    </span>
                                    <span>
                                        <p><b>Available:</b> {{ $book->stock }}</p>
                                    </span>
                                    <span>
                                        <p>
                                            <b>Quantity:</b>
                                            <input type="number" min="1" max="{{ $book->stock }}" wire:model="amount.{{ $book->id }}" class="form-control" wire:change="updateAmount({{ $book->id }})">
                                        </p>
                                        @if (session()->has('greaterThanStock'.$book->id))
                                            <p>
                                                <div class="alert alert-danger">{{ session('greaterThanStock'.$book->id) }}</div>
                                            </p>
                                        @endif
                                    </span>

                                </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div style="margin: 50px;">
                <a href="{{ route('checkout') }}"><button class="btn btn-primary" style="width: 100%">Continue to checkout</button></a>
            </div>
        @endif
    </div>
</div>
