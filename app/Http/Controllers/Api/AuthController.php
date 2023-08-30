<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AuthRequest;
use App\Http\Resources\LoginResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(AuthRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return errorResponse(message: __('auth.login_failed'));
        }

        $user->_token = $user->createToken('our_edu_task')->plainTextToken;


        return successResponse(data: LoginResource::make($user), message: 'Login Successfully');
    }

    public function logout()
    {
        $user = auth()->user();
        $user->currentAccessToken()->delete();
        Auth::guard('sanctum')->forgetUser();

        return successResponse(message: 'Logout Successfully');
    }
}
