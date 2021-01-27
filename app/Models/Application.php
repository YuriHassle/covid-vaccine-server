<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;
    //use DateTimeInterface;

    const CREATED_AT = 'record_date';

    protected $fillable = [
        'user_id',
        'location_id',
        'lot_id',
        'category_id',
        'servicegroup_id',
        'citizen_id',
        'vaccinator_id',
        'application_date',
        'dose',
        'latitude',
        'longitude',
        'updated_by',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function location(){
        return $this->belongsTo(Location::class);
    }
    public function lot(){
        return $this->belongsTo(Lot::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function servicegroup(){
        return $this->belongsTo(Servicegroup::class);
    }
    public function citizen(){
        return $this->belongsTo(Citizen::class);
    }
    public function vaccinator(){
        return $this->belongsTo(Vaccinator::class);
    }

    //this method overrides the default serializeDate to use custom format and timezone 
    protected function serializeDate($date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
