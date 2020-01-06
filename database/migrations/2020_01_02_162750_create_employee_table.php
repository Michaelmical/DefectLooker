<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee', function (Blueprint $table) {
            $table->increments('emp_id');
            $table->string('emp_number');
            $table->string('last_name', 50);
            $table->string('first_name', 50);
            $table->string('middle_name')->nullable();
            $table->string('nick_name')->nullable();
            $table->date('birthdate');
            $table->text('image_path')->nullable();
            $table->timestamps();
        });

        $data = array(
            array(
                'emp_number'        => '4100035',
                'last_name'         => 'SPENCER',
                'first_name'        => 'KARA',
                'middle_name'       => 'ARNOLD',
                'nick_name'         => 'KAY',
                'birthdate'         => '1992-01-01',
                'image_path'        => 'user1-128x128.jpg',
            ),
            array(
                'emp_number'        => '4200040',
                'last_name'         => 'PATTON',
                'first_name'        => 'GERTRUDE',
                'middle_name'       => 'MALONE',
                'nick_name'         => 'GERT',
                'birthdate'         => '1993-01-01',
                'image_path'        => 'user2-160x160.jpg',
            ),
            array(
                'emp_number'        => '4300045',
                'last_name'         => 'JACOBS',
                'first_name'        => 'DARIN',
                'middle_name'       => 'FULLER',
                'nick_name'         => 'RIN',
                'birthdate'         => '1992-01-01',
                'image_path'        => 'user3-128x128.jpg',
            ),
        );

        DB::table('employee')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee');
    }
}
