<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeopleTableSeeder extends Seeder
{
    public function run()
    {
        $param = [
            'name' => 'taro',
            'date' => '1999-12-22',
            'step' => 2000,
            'login' => '2020-10-27',
            'present' => 'aaaaaa',
            'rank' => 150, 
            'point' => 1000
        ];
        DB::table('people')->insert($param);

        $param = [
            'name' => 'hanako',
            'date' => '1985-11-15',
            'step' => 3000,
            'login' => '2020-11-01',
            'present' => 'bbbbbb',
            'rank' => 120, 
            'point' => 2000
        ];
        DB::table('people')->insert($param);
    }
}
