<div>
    <div>
        <h5>Add New Role</h5>
        <br>
        <form class="form-group" wire:submit.prevent.lazy="addRole">
            <input class="form-control" type="text" wire:model="roleName" placeholder="Enter Role name">
            <input class="form-control" type="submit" value="Add Role">
        </form>
    </div>
    <hr>
    <h5>Roles and Permissions list</h5>
    <br>
    <table id="roles" class="table table-striped table-bordered" style="width:100%">
      <thead>
          <tr>
            <th>Name</th>
            <th>Permissions</th>
            <th>Actions</th>
          </tr>
      </thead>
      <tbody>
        @foreach ($roles as $role)
          <tr>
            <td>{{ $role->name }}</td>
            <td>
                @if($role->name === 'admin')
                    All
                @else
                    @foreach($role->permissions as $permission)
                        <li>{{ $permission->name . ' '}} <a href="#" onclick="event.preventDefault()" wire:click="revokePerm({{ $role->id }}, {{ $permission->id }})" style="color: red">Revoke From Role</a></li>
                    @endforeach
                @endif
            </td>
            <td>
                <form class="form-group" wire:submit.prevent.lazy="addPerm({{ $role->id }})">
                    <input class="form-control" type="text" wire:model="permNames.{{ $role->id }}" placeholder="Add Permission - Enter permission name">
                    <input class="form-control" type="submit" value="Add Permission">
                </form>
                <button style="width: 100%" wire:click="deleteRole({{ $role->id }})" class="btn btn-danger">Delete Role</button>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
      
    @section('js')
        <script>
          $(document).ready( function () {
              $('#roles').DataTable();
          } );
        </script>
    @stop
  
  </div>