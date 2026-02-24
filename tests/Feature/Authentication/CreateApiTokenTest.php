<?php

namespace Tests\Feature\Authentication;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class CreateApiTokenTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;

    /** @test */
    public function it_should_create_an_api_token()
    {
        $this->withoutExceptionHandling();

        // Given
        $password = "Strong Password";

        $user = User::factory()->create([
            "password" => Hash::make($password)
        ]);

        $url = route('create-api-token');

        // When
        $response = $this->post($url, [
            "token_name" => "bearer"
        ], [
            "Authorization" => "Basic " . base64_encode($user->email . ":" . $password)
        ]);

        // Then
        $response->assertSee("token");
    }

    /** @test */
    public function it_should_not_create_token_when_user_password_is_wrong()
    {
        $this->withoutExceptionHandling();

        // Given
        $user = User::factory()->create();
        $url = route('create-api-token');
        $password = "Wrong Password";

        // When
        $response = $this->post($url, [
            "token_name" => "bearer"
        ], [
            "Authorization" => "Basic " . base64_encode($user->email . ":" . $password)
        ]);

        // Then
        $response->assertStatus(403);
    }

    /** @test */
    public function it_should_return_error_when_user_does_not_exist()
    {
        // Given
        $url = route('create-api-token');
        $email = "non@existing.email";
        $password = "";

        // When
        $response = $this->post($url, [
            "token_name" => "bearer"
        ], [
            "Authorization" => "Basic " . base64_encode($email . ":" . $password)
        ]);

        // Then
        $response->assertJson([
            "error" => [
                "code" => 1,
                "message" => "User with email address " . $email . " not found"
            ]
        ]);
    }
}
