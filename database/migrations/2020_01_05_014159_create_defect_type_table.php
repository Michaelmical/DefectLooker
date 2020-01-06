<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDefectTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('defect_type', function (Blueprint $table) {
            $table->increments('defect_type_id');
            $table->string('desc_type');
            $table->timestamps();
        });

        $data = array(
            array(
                'desc_type'     =>  'Logic Error'
            ),
            array(
                'desc_type'     =>  'Missed functionality'
            ),
            array(
                'desc_type'     =>  'Missed requirement'
            ),
            array(
                'desc_type'     =>  'Data Error'
            ),
            array(
                'desc_type'     =>  'Other error'
            )
        );

        DB::table('defect_type')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('defect_type');
    }
}
