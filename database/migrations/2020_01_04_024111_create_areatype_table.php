<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreatypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('areatype', function (Blueprint $table) {
            $table->increments('areatype_id');
            $table->string('descr');
            $table->integer('area_id');
            $table->timestamps();
        });

        $data = array(
            array(
                'descr'     =>  'METHODS/PROPERTIES',
                'area_id'   =>  '1'
            ),
            array(
                'descr'     =>  'XAML/VB/RESX',
                'area_id'   =>  '2'
            ),
            array(
                'descr'     =>  'SCHEMA',
                'area_id'   =>  '3'
            ),
            array(
                'descr'     =>  'DATA',
                'area_id'   =>  '3'
            ),
            array(
                'descr'     =>  'VIEWS',
                'area_id'   =>  '3'
            ),
            array(
                'descr'     =>  'STORED PROC',
                'area_id'   =>  '3'
            ),
            array(
                'descr'     =>  'LAYOUT',
                'area_id'   =>  '4'
            ),
            array(
                'descr'     =>  'DATA RETRIEVAL',
                'area_id'   =>  '4'
            ),
            array(
                'descr'     =>  'DATA TRANSFORMATION',
                'area_id'   =>  '4'
            ),
            array(
                'descr'     =>  'XPA/SCL',
                'area_id'   =>  '5'
            ),
            array(
                'descr'     =>  'SCENARIOS',
                'area_id'   =>  '6'
            )
        );

        DB::table('areatype')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('areatype');
    }
}
