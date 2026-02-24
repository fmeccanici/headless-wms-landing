<?php

namespace Tests\Feature\Authentication;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class CreateUserTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;

    /** @test */
    public function it_should_create_a_user_and_a_tenant_if_it_does_not_exist_and_redirect_back_with_success_message()
    {
        // Given
        $this->withoutExceptionHandling();

        $this->get(route('trial'));
        $url = route('create-user');
        $name = 'John Doe';
        $company = 'John Doe B.V.';
        $email = 'johndoe@gmail.com';
        $password = 'JohnDoe@123';

        // When
        $response = $this->post($url, [
            'name' => $name,
            'company' => $company,
            'email' => $email,
            'password' => $password,
            'password_confirmation' => $password
        ]);

        // Then
        $user = User::query()->where('email', $email)->with('tenant')->first();
        $tenant = Tenant::query()->where('name', $company)->first();
        self::assertNotNull($user);
        self::assertNotNull($tenant);
        self::assertEquals($name, $user->name);
        self::assertEquals($company, $tenant->name);
        self::assertEquals($tenant->id, $user->tenant_id);
        self::assertTrue(Hash::check($password, $user->password));
        $response->assertStatus(302);
        $response->assertRedirect(route('trial'));
        $this->followRedirects($response)->assertSee('Successfully created your account! How to use your account? See the docs page.');
    }

    /** @test */
    public function it_should_redirect_with_an_error_if_user_already_exists_with_same_email()
    {
        // Given
        $this->get(route('trial'));
        $url = route('create-user');
        $name = 'John Doe';
        $company = 'John Doe B.V.';
        $email = 'johndoe@gmail.com';
        $password = 'JohnDoe@123';

        User::factory(1)->create([
            'name' => $name,
            'email' => $email,
            'password' => $password
        ]);

        // When
        $response = $this->post($url, [
            'name' => $name,
            'company' => $company,
            'email' => $email,
            'password' => $password,
            'password_confirmation' => $password
        ]);

        // Then
        $response->assertStatus(302);
        $response->assertRedirect(route('trial'));
        $this->followRedirects($response)->assertSee('The email has already been taken.');
    }

    /** @test */
    public function it_should_redirect_with_errors_if_inputs_are_empty()
    {
        // Given
        $this->get(route('trial'));
        $url = route('create-user');


        // When
        $response = $this->post($url);

        // Then
        $response->assertStatus(302);
        $response->assertRedirect(route('trial'));
        $this->followRedirects($response)
            ->assertSee('The name field is required.')
            ->assertSee('The email field is required.')
            ->assertSee('The company field is required.')
            ->assertSee('The password field is required.');
    }
}
