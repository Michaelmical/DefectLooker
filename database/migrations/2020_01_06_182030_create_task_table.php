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
            $table->string('task_id', 8)->primary();
            $table->text('name');
            $table->enum('inc_type', ['BUG','TASK','ENHANCEMENT']);
            $table->enum('severity', ['LOW','MEDIUM','HIGH']);
            $table->date('started_at');
            $table->date('completed_at');
            $table->integer('emp_id');
            $table->integer('build_id');
            $table->boolean('has_functionpts')->default(0);
            $table->timestamps();
        });

        $data = array(
            array(
                'task_id'       => 'ENH00001',
                'name'          => 'EXAMPLE OF ENH NAME',
                'inc_type'      => 'ENHANCEMENT',
                'severity'      => 'HIGH',
                'started_at'    => date('Y/m/d',strtotime("-7 days")),
                'completed_at'  => date('Y/m/d',strtotime("-1 days")),
                'emp_id'        => '1',
                'build_id'      => '1',
            ),
            array(
                'task_id'       => 'TSK00001',
                'name'          => 'EXAMPLE OF TASK NAME1',
                'inc_type'      => 'TASK',
                'severity'      => 'MEDIUM',
                'started_at'    => date('Y/m/d',strtotime("-8 days")),
                'completed_at'  => date('Y/m/d',strtotime("-2 days")),
                'emp_id'        => '2',
                'build_id'      => '1',
            ),
            array(
                'task_id'       => 'TSK00002',
                'name'          => 'EXAMPLE OF TASK NAME2',
                'inc_type'      => 'TASK',
                'severity'      => 'LOW',
                'started_at'    => date('Y/m/d',strtotime("-9 days")),
                'completed_at'  => date('Y/m/d',strtotime("-3 days")),
                'emp_id'        => '2',
                'build_id'      => '2',
            )
        );

        DB::table('task')->insert($data);
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
