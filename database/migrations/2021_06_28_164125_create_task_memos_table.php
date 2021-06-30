<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskMemosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_memos', function (Blueprint $table) {
            //
            $table->BigIncrements('id');
            $table->unsignedInteger('task_id');
            $table->string('title');
            $table->string('memo')->nullable()->default(null);
            $table->unsignedInteger('user_id');
            $table->timestamps();

            $table->foreign('task_id')->references('id')->on('group_tasks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('memos', function (Blueprint $table) {
            //
        });
    }
}
