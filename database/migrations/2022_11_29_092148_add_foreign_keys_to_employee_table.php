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
        Schema::table('employee', function (Blueprint $table) {
            $table->foreign(['positionid'], 'FKemployee650198')->references(['id'])->on('position');
            $table->foreign(['centerid'], 'FKemployee962608')->references(['id'])->on('center');
            $table->foreign(['departmentid'], 'FKemployee839638')->references(['id'])->on('department');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employee', function (Blueprint $table) {
            $table->dropForeign('FKemployee650198');
            $table->dropForeign('FKemployee962608');
            $table->dropForeign('FKemployee839638');
        });
    }
}
