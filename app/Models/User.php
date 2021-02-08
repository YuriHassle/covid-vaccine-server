<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Validator;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    public $errors = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $rules = [];

    protected $attributesName = [
        'email'=>'Email',
        'password' => 'Senha',
        'new_password' => 'Nova senha',
        'new_confirm_password' => 'Confirmar Nova Senha',
    ];

    public function validateUpdatePass($data){

        $this->rules = [
            'password' => 'required',
            'new_password' => 'required|different:password|same:new_confirm_password',
            'new_confirm_password' => 'required'
        ];

        $validator = Validator::make($data, $this->rules, $this->attributes, $this->attributesName);

        $validator->after(function ($validator) {
            if (!Hash::check($validator->getData()['password'], $this->getOriginal('password'))) {
                $validator->errors()->add('password', 'Senha inválida');
            }
        });
        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $message) {
                array_push($this->errors, $message);
            }
            return false;
        }
        return true;
    }

    public function validateUpdate($data){

        $this->rules = [
            'email' => 'required|email',
        ];

        $validator = Validator::make($data, $this->rules);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $message) {
                array_push($this->errors, $message);
            }
            return false;
        }
        return true;
    }


    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}
