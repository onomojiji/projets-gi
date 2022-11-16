<?php

namespace Tests\Feature\Auth;

use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register()
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'sex' => 'M',
            'matricule' => '22INI09783',
            'email' => 'test@example.com',
            'phone' => "344564653423",
            'password' => 'password',
            'confirmpassword' => 'password',
            'birth_date' => '2002-09-10',
            'birth_place' => 'Douala'
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }
}
