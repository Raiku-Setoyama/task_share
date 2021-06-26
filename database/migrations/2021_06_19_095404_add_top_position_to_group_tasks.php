<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTopPositionToGroupTasks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('group_tasks', function (Blueprint $table) {
            //
            $table->integer('top_position')->default(40);
            $table->integer('left_position')->default(40);
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
