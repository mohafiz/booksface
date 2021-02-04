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
                            {{--
                            @if(Auth::user()->animes()->where('anime_id', $anime->id)->first())
                                <div class="alert alert-info">{{$anime->type == 'TV' ? 'This anime' : 'This '.ucfirst($anime->type)}} is in your list</div>
                            @else
                                <button class="btn btn-secondary" style="width: 100%; margin-bottom: 10px;" wire:click="addToList({{$anime->id}})">Add to your list</button>
                            @endif
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

            <div style="margin: 50px;">
                <a href="{{ route('checkout') }}"><button class="btn btn-primary" style="width: 100%">Continue to checkout</button></a>
            </div>
        @endif
    </div>
</div>
