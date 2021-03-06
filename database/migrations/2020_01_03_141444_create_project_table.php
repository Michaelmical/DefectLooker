<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project', function (Blueprint $table) {
            $table->increments('proj_id');
            $table->string('proj_name', 50);
            $table->timestamps();
        });

        $data = array(
            array(
                'proj_name'     => 'TASKFORCE'
            ),
            array(
                'proj_name'     => 'SAVERS'
            ),
            array(
                'proj_name'     => 'CHICOS'
            )
        );

        DB::table('project')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project');
    }
}
