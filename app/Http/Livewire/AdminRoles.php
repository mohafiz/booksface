<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminRoles extends Component
{
    public $roleName;
    public $permNames = [];

    public function mount()
    {
        $roles = Role::all();
        foreach ($roles as $role) {
            $this->permNames[$role->id] = '';
        }
    }

    public function render()
    {
        return view('livewire.admin-roles', [
            'roles' => Role::all(),
        ]);
    }

    public function addRole()
    {
        Role::create(['name' => $this->roleName]);
    }

    public function revokePerm($roleId, $permId)
    {
        $permission = Permission::find($permId);
        Role::find($roleId)->revokePermissionTo($permission);
    }

    public function addPerm($id)
    {
        $permission = Permission::create(['name' => $this->permNames[$id]]);
        Role::find($id)->givePermissionTo($permission);
    }
}
