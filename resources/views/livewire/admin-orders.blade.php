<div>
  <table id="orders" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
          <th>User</th>
          <th>Order Info</th>
          <th>Total price</th>
          <th>Shipping address</th>
          <th>Billing address</th>
          <th>Order date</th>
          <th>Actions</th>
        </tr>
    </thead>
    <tbody>
      @foreach ($orders as $order)
        <tr>
          <td>{{ $order->user->name }}</td>
          <td>
            @foreach($order->books as $book => $quantity)
              <li>{{ $quantity . ' of "' . $book . '"'}}</li>
            @endforeach
          </td>
          <td>{{ $order->TotalPrice.'$' }}</td>
          <td>{{ $order->user->Address }}</td>
          <td>{{ $order->BillingAddress }}</td>
          <td>{{ $order->created_at->diffForHumans() }}</td>
          <td>
            <button wire:click="orderDone({{ $order->id }}, {{ $order->TotalPrice }})" class="btn btn-success">Done</button>
            <button wire:click="deleteOrder({{ $order->id }})" class="btn btn-danger">Delete</button>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
    
  @section('js')
      <script>
        $(document).ready( function () {
            $('#orders').DataTable();
        } );
      </script>
  @stop

</div>