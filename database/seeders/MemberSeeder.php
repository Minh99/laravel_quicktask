<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            ['name'=>'Member A'],
            ['name'=>'Member B'],
            ['name'=>'Member C'],
            ['name'=>'Member D'],
            ['name'=>'Member E'],
            ['name'=>'Member F'],
        );
        DB::table('members')->insert($data);
    }
}
