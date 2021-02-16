<div>
    <div class="container mt-5">
        
        <div style="margin-left: 50px; margin-right: 50%;">
            @if (session()->has('OrderConfirmed'))
                <div class="alert alert-success">{{ session('OrderConfirmed') }}</div>
            @endif
            We have <b>{{$booksCount}}</b> books in our store.
            <br>
            <b>Search for a book:</b> <input class="form-control" type="text" name="searchbooks" wire:model="book" />
        </div>

        <div class="row">
            @foreach($books as $book)
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
                                @if ($book->stock <= 10)
                                <span>
                                   <p style="color: red; text-decoration:underline">Only {{ $book->stock }} books is available in stock.</p>
                                </span>
                                @endif
                                <span>
                                    @if(!Auth::user()->books()->where('book_id', $book->id)->first())
                                        <button class="btn btn-secondary" style="width: 100%; margin-bottom: 10px;" wire:click="addToCart({{$book->id}})">Add to cart</button>
                                    @endif
                                </span>
                            </div>
                        </div>
                </div>
            @endforeach
        </div>
        {{ $books->links() }}
    </div>
</div>
