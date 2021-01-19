<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaccinator extends Model
{
    use HasFactory;

    public $incrementing = false;
    
    protected $fillable = [
        'citizen_id',
    ];

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function citizen(){
        return $this->belongsTo(Citizen::class, 'id', 'id');
    }
}
