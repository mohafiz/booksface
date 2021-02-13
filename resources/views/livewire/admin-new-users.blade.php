<div>
    <table id="newusers" class="table table-striped table-bordered" style="width:100%">
      <thead>
          <tr>
            <th>Username</th>
            <th>Email</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Shipping address</th>
            <th>Alternative address</th>
            <th>State</th>
          </tr>
      </thead>
      <tbody>
        @foreach ($newusers as $user)
          <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->firstName }}</td>
            <td>{{ $user->lastName }}</td>
            <td>{{ $user->Address }}</td>
            <td>{{ $user->secondAddress }}</td>
            <td>{{ $user->State == 1 ? 'Khartoum' : 'Gezira' }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
      
    @section('js')
        <script>
          $(document).ready( function () {
              $('#newusers').DataTable();
          } );
        </script>
    @stop
  
  </div>