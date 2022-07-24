<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\AuthResource;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    public function login(Request $request)
    {

        try {
            $admin = Admin::where('phone', $request->phone)->first();
            if (!$admin || !Hash::check($request->password, $admin->password)) {
                $msg = ['The provided credentials are incorrect.'];
                return send_err('email', $msg);
            }
            $token = $admin->createToken('admin')->plainTextToken;
            return (new AuthResource($admin))
                ->additional(['meta' => [
                    'token' => $token,
                    'token_type' => 'Bearer',
                ]]);
        } catch (\Exception $e) {
            return catch_error($e->getMessage());
        }
    }


    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return send_msg('Admin Logout Success', true, 200);
    }

    public function me(Request $request)
    {
        return AuthResource::make($request->user());
    }
}
