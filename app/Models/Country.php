<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';

    public function users()
    {
    	return $this->hasMany(User::class, 'country_id');
    }
}
