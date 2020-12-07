<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FlowersTableSeeder extends Seeder
{
    public function run()
    {
        $param = [
            'name' => '桜',
            'detail' => 'バラ科・サクラ属'
        ];
        DB::table('flowers')->insert($param);

        $param = [
            'name' => '向日葵',
            'detail' => 'キク科・ヒマワリ属'
        ];
        DB::table('flowers')->insert($param);

        $param = [
            'name' => '秋桜',
            'detail' => 'キク科・コスモス属'
        ];
        DB::table('flowers')->insert($param);
    }
}
