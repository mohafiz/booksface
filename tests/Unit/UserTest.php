<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Spatie\Permission\Contracts\Role;

class UserTest extends TestCase
{    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_user_has_role()
    {
        $user = User::factory()->create();

        $this->assertTrue($user->hasRole('user'));
    }
}
