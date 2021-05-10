<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            ['name'=>'Task One'],
            ['name'=>'Task Two'],
            ['name'=>'Task Three'],
            ['name'=>'Task Four']
        );
        DB::table('tasks')->insert($data);
    }
}
