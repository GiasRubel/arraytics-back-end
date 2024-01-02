<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class LoginController extends Controller
{
    use ApiResponder;

    public function apiLogin(Request $request): JsonResponse
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required|string|min:6'
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->error($validator->errors()->first());
        }
        elseif (!Auth::attemptWhen($request->only('email','password'))) {
            return $this->error('Credentials not match', 401);
        }

        $tokenName = 'AuthToken';

        return $this->success('Login Success', [
            'access_token' => auth()->user()->createToken($tokenName)->plainTextToken,
            'token_type' => 'Bearer'
        ]);
    }
    public function apilogout(Request $request): JsonResponse
    {
        auth()->user()->tokens()->delete();

        return $this->success('Logout Successfully');
    }



}
