<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('area', function (Blueprint $table) {
            $table->increments('area_id');
            $table->string('descr');
            $table->timestamps();
        });

        $data = array(
            array(
                'descr'     => 'API'
            ),
            array(
                'descr'     => 'SCREENS'
            ),
            array(
                'descr'     => 'DATABASE'
            ),
            array(
                'descr'     => 'REPORTS'
            ),
            array(
                'descr'     => 'CONFIGURATIONS'
            ),
            array(
                'descr'     => 'UT SCENARIOS'
            ),
        );

        DB::table('area')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('area');
    }
}
