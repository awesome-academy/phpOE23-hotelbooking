<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';

    protected $fillable = [
    	'name',
    	'phone_code',
    	'lang_code',
    	
    ];

    public function users()
    {
    	return $this->hasMany(User::class, 'country_id');
    }

    public function cities()
    {
    	return $this->hasMany(City::class, 'country_id');
    }
}
