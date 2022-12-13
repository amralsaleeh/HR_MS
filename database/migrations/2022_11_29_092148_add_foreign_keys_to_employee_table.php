<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->foreign(['earlyPositionId'], 'FKpositions650197')->references(['id'])->on('positions');
            $table->foreign(['positionId'], 'FKemployees650198')->references(['id'])->on('positions');
            $table->foreign(['centerId'], 'FKemployees962608')->references(['id'])->on('centers');
            $table->foreign(['departmentId'], 'FKemployees839638')->references(['id'])->on('departments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropForeign('FKpositions650197');
            $table->dropForeign('FKemployees650198');
            $table->dropForeign('FKemployees962608');
            $table->dropForeign('FKemployees839638');
        });
    }
}
