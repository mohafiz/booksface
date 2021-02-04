<div>
    <div class="container">
		<div class="card-details">
			<div class="container-fliud">
				<div class="wrapper-details row">
					<div class="preview-details col-md-6">
						
						<div class="preview-pic-details tab-content-details">
						  <div class="tab-pane active" id="pic-1"><img class="details" src="{{ $book->image }}" /></div>
						</div>
						
					</div>
					<div class="details-details col-md-6">
						<h3 class="product-title-details">{{ $book->title }}</h3>
						<div class="rating-details">
							<div class="stars">
								<span class="fa fa-star checked-detials"></span>
								<span class="fa fa-star checked-details"></span>
								<span class="fa fa-star"></span>
								<span class="fa fa-star"></span>
							</div>
							<span class="review-no">
								{{ $book->subtitle }}
							</span><br>
							<span class="review-no">
								Authors: {{ $book->authors }}
							</span><br>
							<span class="review-no">
								Publisher: {{ $book->publisher }} - Published {{ $book->year }}
							</span><br>
							<span class="review-no">
								Price: {{ $book->price }}
							</span>
						</div>
						<p class="product-description-details">
							{{ $book->desc }}
						</p>
						<span>
							@if(!Auth::user()->books()->where('book_id', $book->id)->first())
								<button class="btn btn-secondary" style="width: 100%; margin-bottom: 10px;" wire:click="addToCart({{$book['isbn13']}})">Add to cart</button>
							@endif
						</span>
						
					</div>
				</div>
			</div>
		</div>
	</div>
	
</div>
