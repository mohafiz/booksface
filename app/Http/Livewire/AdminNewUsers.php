<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;

class AdminNewUsers extends Component
{
    public function render()
    {
        return view('livewire.admin-new-users', [
            'newusers' => User::where('created_at', '>', Carbon::now()->subdays(10))->get(),
        ]);
    }
}
