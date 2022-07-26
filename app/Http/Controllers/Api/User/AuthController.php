<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\RegisterRequest;
use App\Http\Resources\User\AuthResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {

        try {
            $user = User::where('phone', $request->phone)->first();
            if (!$user || !Hash::check($request->password, $user->password)) {
                // throw ValidationException::withMessages([
                //     'email' => ['The provided credentials are incorrect.'],
                // ]);
                $msg = ['The provided credentials are incorrect.'];

                return send_err('email', $msg);
            }


            return  $this->makeToken($user);
        } catch (\Throwable $th) {
            return catch_error($th->getMessage());
        }
    }

    public function register(RegisterRequest $request)
    {
        try {
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'password' => bcrypt($request->input('password')),
            ]);

            return $this->makeToken($user);
        } catch (\Throwable $th) {
            // $th->getMessage();
            return catch_error($th->getMessage());
        }
    }




    public function makeToken($user)
    {
        $token = $user->createToken('user')->plainTextToken;
        return (new AuthResource($user))
            ->additional(['meta' => [
                'token' => $token,
                'token_type' => 'Bearer',
            ]]);
    }


    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return send_msg('Logout Success', true, 200);
    }

    public function me(Request $request)
    {
        return AuthResource::make($request->user());
    }
}
