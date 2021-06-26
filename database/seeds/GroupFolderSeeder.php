<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class GroupFolderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('group_folders')->insert(
            [
            'title' => "サンプル２のフォルダー",
            'group_id' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ],
    );
        DB::table('group_folders')->insert(
            [
            'title' => "サンプル２のフォルダー",
            'group_id' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ],
    );
        DB::table('group_folders')->insert(
            [
            'title' => "サンプル3のフォルダー",
            'group_id' => 3,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ],
    );
        DB::table('group_folders')->insert(
            [
            'title' => "サンプル3のフォルダー",
            'group_id' => 3,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ],
    );
    }
}
