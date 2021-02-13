<div>
    <table id="books" class="table table-striped table-bordered" style="width:100%">
      <thead>
          <tr>
            <th>Title</th>
            <th>Subtitle</th>
            <th>Authors</th>
            <th>ISBN13</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Publisher</th>
            <th>Actions</th>
          </tr>
      </thead>
      <tbody>
        @foreach ($books as $book)
          <tr>
            <td>{{ $book->title }}</td>
            <td>{{ $book->subtitle }}</td>
            <td>{{ $book->authors }}</td>
            <td>{{ $book->isbn13 }}</td>
            <td>{{ $book->price }}</td>
            <td>{{ $book->stock }}</td>
            <td>{{ $book->publisher . ', ' . $book->year }}</td>
            <td>
              <form class="form-group" wire:submit.prevent.lazy="addToStock({{ $book->id }})">
                <input class="form-control" type="number" wire:model="stockAmount">
                <input class="form-control" type="submit" value="Add to stock">
              </form>
              <button style="width: 100%" wire:click="deleteBook({{ $book->id }})" class="btn btn-danger">Delete</button>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
      
    @section('js')
        <script>
          $(document).ready( function () {
              $('#books').DataTable();
          } );
        </script>
    @stop
  
  </div>