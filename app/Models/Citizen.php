<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Citizen extends Model
{
    use HasFactory;
    protected $fillable = [
        'cpf',
        'cns',
        'name',
        'birthday',
    ];

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
    public function vaccinator()
    {
        return $this->hasOne(Vaccinator::class, 'id', 'id');
    }
}
