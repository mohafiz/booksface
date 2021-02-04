<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\anime;

class UserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_user_has_many_animes()
    {
        $user   = User::factory()->create();
        $anime  = anime::factory()->create();

        $user->animes()->attach($anime);

        $this->assertTrue($user->animes->contains($anime));
    }
}
