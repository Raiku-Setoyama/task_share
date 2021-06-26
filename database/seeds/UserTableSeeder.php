<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class UserTableSeeder extends Seeder
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
            DB::table('users')->insert([
                'id' => $num,
                'name' =>"サンプル {$num}",
                'email' =>"test {$num} @test.com",
                'password' =>"password {$num}",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

        }
            DB::table('users')->insert([
                'id' => 4,
                'name' =>"らいく",
                'email' =>"raiku6019@gmail.com",
                'password' =>"raiku0619",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
    

    }
}
