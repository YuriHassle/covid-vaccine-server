<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lot extends Model
{
    use HasFactory;
    protected $fillable = [
        'immunobiological_id',
        'shelf_life',
        'name',
    ];

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function immunobiological(){
        return $this->belongsTo(Immunobiological::class);
    }
}
