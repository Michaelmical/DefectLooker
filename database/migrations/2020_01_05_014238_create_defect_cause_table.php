<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDefectCauseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('defect_cause', function (Blueprint $table) {
            $table->increments('defect_cause_id');
            $table->string('desc_cause');
            $table->timestamps();
        });

        $data = array(
            array(
                'desc_cause'     =>  'Inadequate Self-review/Testing'
            ),
            array(
                'desc_cause'     =>  'Inconsistent Requirements'
            ),
            array(
                'desc_cause'     =>  'Incomplete Requirements'
            ),
            array(
                'desc_cause'     =>  'Incompatible versions'
            ),
            array(
                'desc_cause'     =>  'Data Error - Missing'
            ),
            array(
                'desc_cause'     =>  'Data Error - Incorrect'
            ),
            array(
                'desc_cause'     =>  'User Error'
            ),
            array(
                'desc_cause'     =>  'Lack of Training'
            ),
            array(
                'desc_cause'     =>  'Others'
            )
        );

        DB::table('defect_cause')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('defect_cause');
    }
}
