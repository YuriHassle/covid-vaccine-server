<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;


class AuthController extends BaseController
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed'
        ]);

        $validatedData['password'] = bcrypt($request->password);

        $user = User::create($validatedData);

        $accessToken = $user->createToken('authToken')->accessToken;

        return response([ 'user' => $user, 'access_token' => $accessToken]);
    }

    public function login(Request $request)
    {
        $loginData = $request->validate([
            'cpf' => 'required',
            'password' => 'required'
        ]);

        $loginData['status'] = 1;

        if (!auth()->attempt($loginData)) {
            return $this->sendResponse([], 'Credenciais inválidas');
        }

        $responseData = [
            'user' =>  auth()->user(),
            'access_token' => auth()->user()->createToken('authToken')->accessToken,
        ];
        
        return $this->sendResponse($responseData, 'Login realizado com sucesso');
    }
}
