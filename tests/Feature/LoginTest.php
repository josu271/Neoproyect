<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function login_screen_can_be_rendered()
    {
        $response = $this->get(route('login'));

        $response->assertStatus(200);
        $response->assertViewIs('auth.login');
    }

    /** @test */
    public function users_cannot_authenticate_with_invalid_password()
    {
        $user = User::factory()->create([
            'DNI' => '87654321',
            'password' => Hash::make('correct-password'),
        ]);

        $response = $this->from(route('login'))->post(route('login'), [
            'dni' => '87654321',
            'password' => 'wrong-password',
        ]);

        $response->assertRedirect(route('login'));
        $response->assertSessionHasErrors(['dni']);
        $this->assertGuest();
    }

    /** @test */
    public function authenticated_user_can_logout()
    {
        $user = User::factory()->create([
            'DNI' => '55556666',
            'password' => Hash::make('logout123'),
        ]);

        // Log in first
        $this->actingAs($user);

        $response = $this->post(route('logout'));

        $response->assertRedirect('/login');
        $this->assertGuest();
    }

    /** @test */
    public function guests_are_redirected_to_login_when_accessing_menu()
    {
        $response = $this->get('/menu');

        $response->assertRedirect(route('login'));
    }
}
