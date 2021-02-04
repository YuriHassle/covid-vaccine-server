<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Hash;

class AuthController extends BaseController
{
    private $user;

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
            return $this->sendResponse(['successful_login' => false,], 'Credenciais inválidas');
        }

        $responseData = [
            'successful_login' => true,
            'user' =>  auth()->user(),
            'access_token' => auth()->user()->createToken('authToken')->accessToken,
        ];

        return $this->sendResponse($responseData, 'Login realizado com sucesso');
    }

    public function updatePassword(Request $request)
    {
        $this->user = User::find(auth()->user()->id);

        $errors = ['errors'=>[]];

        if (!$this->user->validateUpdatePass($request->all())) {
            $errors['errors'] = $this->user->errors;
            return $this->sendResponse($errors, 'Dados inválidos');
        }

        $this->user->update(['password'=> Hash::make($request->new_password)]);

        return $this->sendResponse($errors, 'Senha atualizada com sucesso');

    }

    public function update(Request $request)
    {
        $this->user = User::find(auth()->user()->id);

        $errors = ['errors'=>[]];

        if (!$this->user->validateUpdate($request->all())) {
            $errors['errors'] = $this->user->errors;
            return $this->sendResponse($errors, 'Dados inválidos');
        }

        $this->user->update(['email'=> $request->email]);

        return $this->sendResponse($errors, 'Email atualizado com sucesso');

    }
}
