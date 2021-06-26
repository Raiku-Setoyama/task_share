<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWorkingUserNameToGroupTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('group_tasks', function (Blueprint $table) {
            
            //ちゃんとデフォルトがnullになってるかデータベースで確認。
            $table->unsignedInteger('user_id')->nullable()->default(null);
            $table->string('working_user_name',50)->nullable()->default(null);
            $table->softDeletes();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('group_tasks', function (Blueprint $table) {
            //
        });
    }
}
