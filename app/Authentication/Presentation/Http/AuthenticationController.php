<?php


namespace App\Authentication\Presentation\Http;


use App\Authentication\Presentation\Http\Requests\CreateUserRequest;
use App\Models\Tenant;
use App\Models\User;

class AuthenticationController
{
    public function createUser(CreateUserRequest $request)
    {
        $tenant = Tenant::query()->where('name', $request->input('company'))->firstOrCreate([
            'name' => $request->input('company')
        ]);

        $name = $request->input('name');
        $password = $request->input('password');
        $email = $request->input('email');
        $tenantId = $tenant->id;

        $user = User::factory(1)->create([
            'name' => $name,
            'password' => bcrypt($password),
            'email' => $email,
            'tenant_id' => $tenantId
        ])->first();

        return redirect()->back()->with('success', 'Successfully created your account! How to use your account? See the docs page.');
    }
}
