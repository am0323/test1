<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MapsTableSeeder extends Seeder
{
    public function run()
    {
        $param = [
            'photo' => 'aaaaaaaaa',
            'date' => '2020-11-09-17-30-27',
            'area' => '横浜市'
        ];
        DB::table('maps')->insert($param);

        $param = [
            'photo' => 'bbbbbbbb',
            'date' => '2020-10-10-22-00-50',
            'area' => '横浜市'
        ];
        DB::table('maps')->insert($param);

        $param = [
            'photo' => 'ccccccccc',
            'date' => '2020-11-10-09-22-38',
            'area' => '横浜市'
        ];
        DB::table('maps')->insert($param);
    }
}
