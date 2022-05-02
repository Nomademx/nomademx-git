<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    public function state(){
        return $this->belongsTo(State::class);
    }

    public function suburbs(){
        return $this->hasMany(Suburb::class);
    }

    public function sales(){
        return $this->hasMany(Sale::class);
    }
}
