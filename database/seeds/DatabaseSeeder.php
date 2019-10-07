<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            ['name' => 'normal'],
            ['name' => 'admin'],
            ['name' => 'root'],

        ]);

        DB::table('permission')->insert([
            ['name' => 'search accommodations'],
            ['name' => 'create card'],
            ['name' => 'edit card'],
            ['name' => 'delete card'],
            ['name' => 'edit user'],
            ['name' => 'create role'],
            ['name' => 'edit role'],
            ['name' => 'delete role'],
            ['name' => 'create permission'],
            ['name' => 'edit permission'],
            ['name' => 'delete permission'],
            ['name' => 'create hotel'],
            ['name' => 'edit hotel'],
            ['name' => 'delete hotel'],
            ['name' => 'create service'],
            ['name' => 'edit service'],
            ['name' => 'delete service'],
            ['name' => 'create currency'],
            ['name' => 'edit currency'],
            ['name' => 'delete currency'],
            ['name' => 'create price'],
            ['name' => 'edit price'],
            ['name' => 'delete price'],
            ['name' => 'create room type'],
            ['name' => 'edit room type'],
            ['name' => 'delete room type'],
            ['name' => 'create room quantity'],
            ['name' => 'edit room quantity'],
            ['name' => 'delete room quantity'],

        ]);

        
    }
}
