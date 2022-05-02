<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'country_id',
        'state_id',
        'city_id',
        'suburb_id',
        'description',
        'status',
        'property_type',
        'location',
        'price',
        'sale_type',
        'image',
        'sold_at'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function suburb(){
        return $this->belongsTo(Suburb::class);
    }

    public function city(){
        return $this->belongsTo(City::class);
    }

    public function state(){
        return $this->belongsTo(State::class);
    }

    public function country(){
        return $this->belongsTo(Country::class);
    }
}
