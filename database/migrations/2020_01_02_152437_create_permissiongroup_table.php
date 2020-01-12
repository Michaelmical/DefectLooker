<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissiongroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissiongroup', function (Blueprint $table) {
            $table->smallIncrements('grp_id');
            $table->enum('type', ['ADMIN', 'USER']);
            $table->timestamps();
        });

        $data = array(
            array(
                'type'     => 'ADMIN',
            ),
            array(
                'type'     => 'USER',
            )
        );

        DB::table('permissiongroup')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissiongroup');
    }
}
