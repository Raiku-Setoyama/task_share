<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class UserGroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('user_group')->insert([
            'user_id' => 4,
            'group_id' =>2,

        ]);
        DB::table('user_group')->insert([
            'user_id' => 4,
            'group_id' =>3,
            
        ]);
        DB::table('user_group')->insert([
            'user_id' => 2,
            'group_id' =>2,
        ]);
        DB::table('user_group')->insert([
            'user_id' => 5,
            'group_id' =>2,
        ]);
    }


}
