<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /* @test */
    public function it_can_create_a_user_using_factory()
    {
        // Tworzymy użytkownika za pomocą fabryki
        $user = User::factory()->create();

        // Sprawdzamy, czy użytkownik został poprawnie zapisany w bazie
        $this->assertDatabaseHas('users', [
            'email' => $user->email,
        ]);
    }

    /* @test */
    public function it_hides_sensitive_attributes()
    {
        $user = User::factory()->create();

        // Sprawdzamy, czy ukryte atrybuty nie są widoczne w tablicy
        $this->assertArrayNotHasKey('password', $user->toArray());
        $this->assertArrayNotHasKey('remember_token', $user->toArray());
    }

    /* @test*/
    public function it_hashes_passwords()
    {
        $password = 'plain-text-password';

        // Tworzymy użytkownika z określonym hasłem
        $user = User::factory()->create([
            'password' => Hash::make($password),
        ]);

        // Sprawdzamy, czy hasło zostało poprawnie zahaszowane
        $this->assertTrue(Hash::check($password, $user->password));
    }

    /* @test */
    public function it_casts_email_verified_at_to_datetime()
    {
        $user = User::factory()->create();

        // Sprawdzamy, czy email_verified_at jest instancją DateTime
        $this->assertInstanceOf(\DateTime::class, $user->email_verified_at);
    }

    /* @test */
    public function it_assigns_roles_correctly()
    {
        // Tworzymy użytkownika z fabryki
        $user = User::factory()->create();

        // Sprawdzamy, czy użytkownik ma przypisaną rolę USER (z HasRoles)
        $this->assertTrue($user->hasRole('user'));
    }
}