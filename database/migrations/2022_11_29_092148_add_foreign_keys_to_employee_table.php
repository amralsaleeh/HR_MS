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
            $table->foreign(['positionid'], 'FKemployees650198')->references(['id'])->on('positions');
            $table->foreign(['centerid'], 'FKemployees962608')->references(['id'])->on('centers');
            $table->foreign(['departmentid'], 'FKemployees839638')->references(['id'])->on('departments');
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
            $table->dropForeign('FKemployees650198');
            $table->dropForeign('FKemployees962608');
            $table->dropForeign('FKemployees839638');
        });
    }
}
