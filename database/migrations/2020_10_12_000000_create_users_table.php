<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('emp_id')->unsigned();
            $table->smallInteger('grp_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('users', function($table) {
            $table->foreign('grp_id')->references('grp_id')->on('permissiongroup');
            $table->foreign('emp_id')->references('emp_id')->on('employee');
        });

        $data = array(
            array(
                'email'     => 'admin@gmail.com',
                'password'  => '$2y$10$6GzdrmzKr.doVtAAH2zHru2h.HzNixVkPhjDaLzAfl0c8hBblXhje', //adminpass
                'emp_id'    => '1',
                'grp_id'    => '1'
            ),
            array(
                'email'     => 'user1@gmail.com',
                'password'  => '$2y$10$hEHxDiFUTew7EAdCVfyiluJiLOB64blqxF/fR.jxeGlYTPUwjgG/q', //user1pass
                'emp_id'    => '2',
                'grp_id'    => '2'
            )
        );

        DB::table('users')->insert($data);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
