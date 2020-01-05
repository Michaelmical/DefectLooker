<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task', function (Blueprint $table) {
            $table->increments('task_id');
            $table->string('ref_id', 8);
            $table->enum('inc_type', ['bug','task','enhancement']);
            $table->enum('severity', ['low','medium','high']);
            $table->date('started_at');
            $table->date('completed_at');
            $table->integer('emp_id');
            $table->integer('build_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task');
    }
}
