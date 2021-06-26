<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class GroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        foreach(range(1,3) as $num){
            DB::table('groups')->insert([
                'id' => $num,
                'name' =>"サンプル {$num}",
                'password' =>"password {$num}",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

        }
    }
}
