<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicegroup extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'name',
    ];

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
