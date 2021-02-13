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
                        {{--
                        @if(Auth::user()->animes()->where('anime_id', $anime->id)->first())
                            <div class="alert alert-info">{{$anime->type == 'TV' ? 'This anime' : 'This '.ucfirst($anime->type)}} is in your list</div>
                        @else
                            <button class="btn btn-secondary" style="width: 100%; margin-bottom: 10px;" wire:click="addToList({{$anime->id}})">Add to your list</button>
                        @endif
                        @if(Auth::user()->isAdmin())
                            @if($anime->episodes && $anime->episodes()->count() != $anime->episodes)
                                <button wire:click="addAllEpisodes({{$anime->id}})" style="width: 100%; margin-top: 10px; margin-bottom: 10px;" class="btn btn-secondary">Add all episodes</button>
                                <div wire:loading wire:target="addAllEpisodes">
                                    <div class="spinner-border" role="status">
                                      <span class="sr-only">Loading...</span>
                                    </div>
                                </div>
                            @endif
                            <div class="alert alert-info">
                                {{
                                    in_array(null, $anime->episodes()->pluck('episode_link')->toArray()) ? 'Not Completed: '.array_search(null, $anime->episodes()->pluck('episode_link')->toArray()) : 'Completed'
                                }}
                            </div>

                            <button class="btn btn-secondary" style="width: 100%" wire:click="update({{$anime->id}})">Update Info</button>
                        @endif
                        --}}
                    </div>
                </div>
            @endforeach
        </div>
        {{ $books->links() }}
    </div>
</div>
