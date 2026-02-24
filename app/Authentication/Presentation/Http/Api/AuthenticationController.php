<?php


namespace App\Authentication\Presentation\Http\Api;


use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationController
{
    public function createApiToken()
    {
        $credentials = request()->header('Authorization');
        $credentialsDecoded = base64_decode(explode("Basic ", $credentials)[1]);
        $username = explode(":", $credentialsDecoded)[0];
        $password = explode(":", $credentialsDecoded)[1];

        $user = User::where(['email' => $username] )->first();

        if (! $user)
        {
            $response["error"]["code"] = 1;
            $response["error"]["message"] = "User with email address " . $username . " not found";

            return $response;
        }

        if (! Hash::check($password, $user->password))
        {
            $response["error"]["code"] = 403;
            $response["error"]["message"] = "Username and password combination is wrong";

            return response($response, 403);
        }

        $tokenName = request()->token_name;

        if ($tokenName === null)
        {
            $tokenName = "bearer";
        }

        Auth::setUser($user);
        $token = request()->user()->createToken($tokenName);
        return ['token' => $token->plainTextToken];
    }
}
