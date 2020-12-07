<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(FlowersTableSeeder::class);
        //$this->call(PeopleTableSeeder::class);
        //$this->call(MapsTableSeeder::class);
        //$this->call(PresentsTableSeeder::class);
    }
}
