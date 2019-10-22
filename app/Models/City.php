<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'cities';

    protected $fillable = [
    	'name',
    	'country_id',
    	'image',
    	'description',

    ];

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function hotels()
    {
        return $this->hasMany(Hotel::class, 'city_id');
    }
}
