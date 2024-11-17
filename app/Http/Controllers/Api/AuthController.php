<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(UserRequest $request)
    {
        $user = User::create($request->validated());
        return response(null, 201);
    }

    function login(Request $request)
    {
        $user = User::where('email',  $request->email)->first();
        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => ['Credênciais inválidas'],
            ]);
        }

        $user->tokens()->delete();

        return response()->json([
            'status' => true,
            'message' => 'Usuário logado com sucesso',
            'token' => $user->createToken('auth_token')->plainTextToken,
        ]);
    }

    public function logout(Request $request)
    {
        $user = $request->user('sanctum');

        if($user)
        {
            $user->currentAccessToken()->delete();
            return response(null, 204);
        }

        return response(null, 401);
    }
}
