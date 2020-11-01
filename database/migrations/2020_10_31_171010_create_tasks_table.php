<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('title');
            $table->string('description')->nullable();
            $table->date('deadline')->nullable();
            $table->tinyInteger('deleted')->default(0);

            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('assigned_to');
            $table->unsignedBigInteger('tag_id')->default(4);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
