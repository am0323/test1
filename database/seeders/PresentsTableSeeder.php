<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PresentsTableSeeder extends Seeder
{
    public function run()
    {
        $param = [
            'season' => '春',
            'seed' => 'face1.png',
            'bud' => 'hijklmn',
            'grow' => 'opqrstu',
            'flower' => 'vwxyzzz',
        ];
        DB::table('presents')->insert($param);

        $param = [
            'season' => '夏',
            'seed' => 'cccccccc',
            'bud' => 'bbbbbbbb',
            'grow' => 'abababab',
            'flower' => 'mmmmmmm',
        ];
        DB::table('presents')->insert($param);

        $param = [
            'season' => '秋',
            'seed' => 'face2.png',
            'bud' => 'face1.png',
            'grow' => 'MS_logo.png',
            'flower' => 'Yahoo_logo.png',
        ];
        DB::table('presents')->insert($param);
    }
}
