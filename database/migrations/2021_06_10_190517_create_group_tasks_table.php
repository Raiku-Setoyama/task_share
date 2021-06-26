<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_tasks', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('group_folder_id')->unsigned();
            $table->string('title', 100);
            $table->date('due_date');
            $table->integer('status')->default(1);
            $table->timestamps();

            $table->foreign('group_folder_id')->references('id')->on('group_folders')->onDelete('cascade');        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_tasks');
    }
}
