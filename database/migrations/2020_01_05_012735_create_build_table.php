<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuildTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('build', function (Blueprint $table) {
            $table->increments('build_id');
            $table->integer('proj_id');
            $table->string('descr');
            $table->timestamps();
        });

        $data = array(
            array(
                'proj_id'       => '1',
                'descr'          => 'TASKFORCE1.0DROP1',
            ),
            array(
                'proj_id'       => '2',
                'descr'          => 'SAVERS1.0DROP1',
            ),
            array(
                'proj_id'       => '3',
                'descr'          => 'CHICOS1.0DROP1',
            ),
        );

        DB::table('build')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('build');
    }
}
