<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplexTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complex', function (Blueprint $table) {
            $table->increments('complex_id');
            $table->string('descr');
            $table->decimal('weight', 8, 2);
            $table->text('criteria');
            $table->integer('areatype_id');
            $table->timestamps();
        });

        $data = array(
            //API-METHODS/PROPERTIES-1
            array(
                'descr'       => 'Very Simple',
                'weight'       => '1.00',
                'criteria'       => '1-2 validation checks\r\nor \r\n1-2 basic operations of add, subtruct, multiply or divide\r\nor\r\nSet 1-5 variables',
                'areatype_id'       => '1'
            ),
            array(
                'descr'       => 'Simple',
                'weight'       => '2.00',
                'criteria'       => '3-5 validation checks\r\nor \r\n3-5 basic operations of add, subtruct, multiply or divide\r\nor\r\nSet over 5 variables',
                'areatype_id'       => '1'
            ),
            array(
                'descr'       => 'Medium',
                'weight'       => '3.00',
                'criteria'       => '5-8 validation checks\r\nor\r\nData CRUD or transformation from 1-2 objects',
                'areatype_id'       => '1'
            ),
            array(
                'descr'       => 'Complex',
                'weight'       => '4.00',
                'criteria'       => '9-10 validation checks\r\nor\r\nData CRUD or transformation from 3-5 objects',
                'areatype_id'       => '1'
            ),
            array(
                'descr'       => 'Very Complex',
                'weight'       => '5.00',
                'criteria'       => 'Over 10 validation checks\r\nor\r\nData CRUD from over 5 objects \r\nor Involves complex transformation of the data retrieved',
                'areatype_id'       => '1'
            ),

            //SCREENS-XAML/VB/RESX-2
            array(
                'descr'       => 'Very Simple',
                'weight'       => '1.00',
                'criteria'       => 'Add/Modify/Delete 1-3\r\n- textbox\r\n- radiobutton\r\n- checkbox\r\n- dropdown list\r\n- button\r\nAdd/Modify/Delete 1-5 labels',
                'areatype_id'       => '2'
            ),
            array(
                'descr'       => 'Simple',
                'weight'       => '2.00',
                'criteria'       => 'Add/Modify/Delete 4 - 6\r\n- textbox\r\n- radiobutton\r\n- checkbox\r\n- dropdown list\r\n- button\r\nAdd/Modify/Delete 1-2\r\n- table/grid - retrieval and display only\r\nAdd/Modify/Delete 6-10 labels',
                'areatype_id'       => '2'
            ),
            array(
                'descr'       => 'Medium',
                'weight'       => '3.00',
                'criteria'       => 'Add/Modify/Delete 7 - 10\r\n- textbox\r\n- radiobutton\r\n- checkbox\r\n- dropdown list\r\n- button\r\nAdd/Modify/Delete 3 - 4\r\n- table/grid - retrieval and display only\r\nAdd/Modify/Delete 1-2\r\n- table/grid - with updateable rows, calculations, or pop-up window\r\nAdd/Modify/Delete over 10 labels',
                'areatype_id'       => '2'
            ),
            array(
                'descr'       => 'Complex',
                'weight'       => '4.00',
                'criteria'       => 'Add/Modify/Delete over 10\r\n- textbox\r\n- radiobutton\r\n- checkbox\r\n- dropdown list\r\n- button\r\nAdd/Modify/Delete over 4\r\n- table/grid - retrieval and display only\r\nAdd/Modify/Delete over 2\r\n- table/grid - with updateable rows, calculations, or pop-up window ',
                'areatype_id'       => '2'
            ),

            //DATABASE-SCHEMA-3
            array(
                'descr'       => 'Very Simple',
                'weight'       => '0.50',
                'criteria'       => '1-3 changes to the tables\schema',
                'areatype_id'       => '3'
            ),
            array(
                'descr'       => 'Simple',
                'weight'       => '1.00',
                'criteria'       => '4-5 changes to the tables\schema',
                'areatype_id'       => '3'
            ),
            array(
                'descr'       => 'Medium',
                'weight'       => '1.50',
                'criteria'       => '5-10 changes to the tables\schema or New table with 10 columns',
                'areatype_id'       => '3'
            ),
            array(
                'descr'       => 'Complex',
                'weight'       => '2.00',
                'criteria'       => 'Over 10 changes to the table\'s schema\r\nOr\r\nNew table with over 10 columns',
                'areatype_id'       => '3'
            ),
            //DATABASE-DATA-4
            array(
                'descr'       => 'Very Simple',
                'weight'       => '0.25',
                'criteria'       => '0-1 CUD records',
                'areatype_id'       => '4'
            ),
            array(
                'descr'       => 'Simple',
                'weight'       => '0.50',
                'criteria'       => '2-10 CUD records',
                'areatype_id'       => '4'
            ),
            array(
                'descr'       => 'Medium',
                'weight'       => '0.75',
                'criteria'       => '11-20 CUD records',
                'areatype_id'       => '4'
            ),
            array(
                'descr'       => 'Complex',
                'weight'       => '1.00',
                'criteria'       => '21-30 CUD records',
                'areatype_id'       => '4'
            ),
            array(
                'descr'       => 'Very Complex',
                'weight'       => '1.25',
                'criteria'       => 'Over 30 CUD records',
                'areatype_id'       => '4'
            ),
            //DATABASE-VIEWS-5
            array(
                'descr'       => 'Very Simple',
                'weight'       => '0.75',
                'criteria'       => 'Adding/deleting 1-5 columns',
                'areatype_id'       => '5'
            ),
            array(
                'descr'       => 'Simple',
                'weight'       => '1.50',
                'criteria'       => 'Adding/deleting 5-10 columns',
                'areatype_id'       => '5'
            ),
            array(
                'descr'       => 'Medium',
                'weight'       => '2.25',
                'criteria'       => 'Adding/deleting 11-20 columns \r\nor\r\njoining 2 tables',
                'areatype_id'       => '5'
            ),
            array(
                'descr'       => 'Complex',
                'weight'       => '3.00',
                'criteria'       => 'Adding/deleting over20\r\nor\r\njoining 2-3 tables',
                'areatype_id'       => '5'
            ),
            array(
                'descr'       => 'Very Complex',
                'weight'       => '3.75',
                'criteria'       => 'Joining over 3 tables',
                'areatype_id'       => '5'
            ),
            //DATABASE-STORED PROC-6
            array(
                'descr'       => 'Very Simple',
                'weight'       => '1.00',
                'criteria'       => '1 referenced object with 1-2 basic operations of add, subtract, multiply or divide',
                'areatype_id'       => '6'
            ),
            array(
                'descr'       => 'Simple',
                'weight'       => '2.00',
                'criteria'       => '2-3 referenced object with 3-5 basic operations of add, subtruct, multiply or divide',
                'areatype_id'       => '6'
            ),
            array(
                'descr'       => 'Medium',
                'weight'       => '3.00',
                'criteria'       => '4-6 referenced object with over 5 basic operations of add, subtruct, multiply or divide',
                'areatype_id'       => '6'
            ),
            array(
                'descr'       => 'Complex',
                'weight'       => '4.00',
                'criteria'       => '6-10 referenced object with over 5 basic operations of add, subtruct, multiply or divide',
                'areatype_id'       => '6'
            ),
            array(
                'descr'       => 'Very Complex',
                'weight'       => '5.00',
                'criteria'       => 'Over 10 referenced object with over 5 basic operations of add, subtruct, multiply or divide',
                'areatype_id'       => '6'
            ),
            //REPORTS-LAYOUT-7
            array(
                'descr'       => 'Very Simple',
                'weight'       => '0.50',
                'criteria'       => 'List with 1-5 columns',
                'areatype_id'       => '7'
            ),
            array(
                'descr'       => 'Simple',
                'weight'       => '1.00',
                'criteria'       => 'List with 5-8 columns',
                'areatype_id'       => '7'
            ),
            array(
                'descr'       => 'Medium',
                'weight'       => '1.50',
                'criteria'       => 'List with 1 total and 1 sub total',
                'areatype_id'       => '7'
            ),
            array(
                'descr'       => 'Complex',
                'weight'       => '2.00',
                'criteria'       => 'List with 1 total and 2-3 sub totals',
                'areatype_id'       => '7'
            ),
            array(
                'descr'       => 'Very Complex',
                'weight'       => '2.50',
                'criteria'       => 'List with 1 total and over 3 sub totals',
                'areatype_id'       => '7'
            ),
            //REPORTS-DATARETRIEVAL-8
            array(
                'descr'       => 'Very Simple',
                'weight'       => '1.00',
                'criteria'       => 'From 1 object',
                'areatype_id'       => '8'
            ),
            array(
                'descr'       => 'Simple',
                'weight'       => '2.00',
                'criteria'       => 'From 2 objects',
                'areatype_id'       => '8'
            ),
            array(
                'descr'       => 'Medium',
                'weight'       => '3.00',
                'criteria'       => 'From 3-4 objects',
                'areatype_id'       => '8'
            ),
            array(
                'descr'       => 'Complex',
                'weight'       => '4.00',
                'criteria'       => 'From 5-6 objects',
                'areatype_id'       => '8'
            ),
            array(
                'descr'       => 'Very Complex',
                'weight'       => '5.00',
                'criteria'       => 'From over 7 objects',
                'areatype_id'       => '8'
            ),
            //REPORTS-DATATRANSFORMATION-9
            array(
                'descr'       => 'Very Simple',
                'weight'       => '1.00',
                'criteria'       => '1-4 basic operations like add, subtract, multiply and divide',
                'areatype_id'       => '9'
            ),
            array(
                'descr'       => 'Simple',
                'weight'       => '2.00',
                'criteria'       => '5-10 basic operations like add, subtract, multiply and divide',
                'areatype_id'       => '9'
            ),
            array(
                'descr'       => 'Medium',
                'weight'       => '3.00',
                'criteria'       => '11-15 basic operations like add, subtract, multiply and divide\r\nor 1-4 use of statistical functions like averages, deviations, percentages',
                'areatype_id'       => '9'
            ),
            array(
                'descr'       => 'Complex',
                'weight'       => '4.00',
                'criteria'       => 'over 15 basic operations like add, subtract, multiply and divide\r\nor 5-10 use of statistical functions like averages, deviations, percentages',
                'areatype_id'       => '9'
            ),
            array(
                'descr'       => 'Very Complex',
                'weight'       => '5.00',
                'criteria'       => 'Use of over 10  statistical functions like averages, deviations, percentages or advanced mathematics or must solve a very particular process.',
                'areatype_id'       => '9'
            ),
            //CONFIGURATIONS-XPASCL-10
            array(
                'descr'       => 'Very Simple',
                'weight'       => '1.00',
                'criteria'       => 'Adding/Modifying 1-10 nodes',
                'areatype_id'       => '10'
            ),
            array(
                'descr'       => 'Simple',
                'weight'       => '2.00',
                'criteria'       => 'Adding/Modifying 11-20 nodes',
                'areatype_id'       => '10'
            ),
            array(
                'descr'       => 'Medium',
                'weight'       => '3.00',
                'criteria'       => 'Adding/Modifying 21-30 nodes',
                'areatype_id'       => '10'
            ),
            array(
                'descr'       => 'Complex',
                'weight'       => '4.00',
                'criteria'       => 'Adding/Modifying 31-40 nodes',
                'areatype_id'       => '10'
            ),
            array(
                'descr'       => 'Very Complex',
                'weight'       => '5.00',
                'criteria'       => 'Adding/Modifying over 40 nodes',
                'areatype_id'       => '10'
            ),
            //UTC-SCENARIOS-11
            array(
                'descr'       => 'Very Simple',
                'weight'       => '0.25',
                'criteria'       => '1-4 steps',
                'areatype_id'       => '11'
            ),
            array(
                'descr'       => 'Simple',
                'weight'       => '0.50',
                'criteria'       => '5-8 steps',
                'areatype_id'       => '11'
            ),
            array(
                'descr'       => 'Medium',
                'weight'       => '0.75',
                'criteria'       => '9-12 steps',
                'areatype_id'       => '11'
            ),
            array(
                'descr'       => 'Complex',
                'weight'       => '1.00',
                'criteria'       => 'Over 12 steps',
                'areatype_id'       => '11'
            )

        );

        DB::table('complex')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('complex');
    }
}
