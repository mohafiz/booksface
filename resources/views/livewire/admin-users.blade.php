<div>
    <table id="users" class="table table-striped table-bordered" style="width:100%">
      <thead>
          <tr>
            <th>Username</th>
            <th>Email</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Shipping address</th>
            <th>Alternative address</th>
            <th>State</th>
            <th>Role</th>
            <th>Actions</th>
          </tr>
      </thead>
      <tbody>
        @foreach ($users as $user)
          <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->firstName }}</td>
            <td>{{ $user->lastName }}</td>
            <td>{{ $user->Address }}</td>
            <td>{{ $user->secondAddress }}</td>
            <td>{{ $user->State == 1 ? 'Khartoum' : 'Gezira' }}</td>
            <td>
                @foreach ($user->getRoleNames() as $role)
                    {{ $loop->last ? $role : $role.','}}
                @endforeach
            </td>
            <td>
                <button style="width: 100%" wire:click="makeAdmin({{ $user->id }})" class="btn btn-success">Make Admin</button>
                <br>
                <button style="width: 100%" wire:click="deleteUser({{ $user->id }})" class="btn btn-danger">Delete</button>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
      
    @section('js')
        <script>
          $(document).ready( function () {
              $('#users').DataTable();
          } );
        </script>
    @stop
  
  </div>