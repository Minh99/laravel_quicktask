<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            ['task_id'=> 1,'member_id'=> 1,],
            ['task_id'=> 1,'member_id'=> 3,],
            ['task_id'=> 2,'member_id'=> 2,],
            ['task_id'=> 2,'member_id'=> 4,]
        );

        DB::table('plans')->insert($data);
    }
}
