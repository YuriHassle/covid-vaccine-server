<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Validator;
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
        $data = ['errors'=> []];

        $validator = Validator::make($request->all(), [
            'password' => ['required', function ($attribute, $value, $fail) {
                if (!Hash::check($value, $this->user->password)) {
                    $fail('The '.$attribute.' is invalid.');
                }
            },],
            'new_password' => 'required|different:password',
            'new_confirm_password' => 'required|same:new_password'
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $message) {
                array_push($data['errors'], $message);
            }
            return $this->sendResponse($data, 'Dados inválidos');
        }

        $this->user->update(['password'=> Hash::make($request->new_password)]);

        return $this->sendResponse($data, 'Senha atualizada com sucesso');

    }
}
