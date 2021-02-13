<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class AdminUsers extends Component
{
    public function render()
    {
        return view('livewire.admin-users', [
            'users' => User::all()
        ]);
    }

    public function makeAdmin($id)
    {
        User::find($id)->assignRole('admin');
    }

    public function deleteUser($id)
    {
        User::find($id)->delete();
    }
}
