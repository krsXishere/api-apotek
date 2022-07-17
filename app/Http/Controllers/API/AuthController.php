<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Helpers\APIFormatter;

class AuthController extends Controller
{
    public function register(Request $request) {
        $fields = $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'username' => 'required|string|unique:users,username',
            'password' => 'required|string|confirmed',
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'address' => $fields['address'],
            'username' => $fields['username'],
            'password' => bcrypt($fields['password']),
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'status' => 200,
            'token' => $token,
            'message' => 'Succes',
            'user' => $user,
        ];

        return response($response, 201);
    }

    public function login(Request $request) {
        $fields = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('username', $fields['username'])->first();

        if(!$user || !Hash::check($fields['password'], $user->password)){
            return response([
                'message' => 'Gagal Login'
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'status' => 200,
            'token' => $token,
            'message' => 'Succes',
            'user' => $user,
        ];

        return response($response, 201);
    }

    public function logout(Request $request) {
        $token = $request->user()->currentAccessToken()->delete();

        return APIFormatter::createAPI(200, 'Success', $token);
    }

    public function fetch(Request $request) {
        return APIFormatter::createAPI(200, 'Success', $request->user());
    }
}
