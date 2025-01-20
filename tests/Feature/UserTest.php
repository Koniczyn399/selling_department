<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


use App\Models\User;

use Illuminate\Support\Facades\Hash;


class UserTest extends TestCase
{

    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function it_can_create_a_user_using_factory()
    {
        // Tworzymy użytkownika za pomocą fabryki
        $user = User::factory()->create();

        // Sprawdzamy, czy użytkownik został poprawnie zapisany w bazie
        $this->assertDatabaseHas('users', [
            'email' => $user->email,
        ]);
    }
}
