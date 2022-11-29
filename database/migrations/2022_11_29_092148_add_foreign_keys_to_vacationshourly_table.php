<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToVacationshourlyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vacationshourly', function (Blueprint $table) {
            $table->foreign(['employeeid'], 'FKvacationsh692359')->references(['id'])->on('employee');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vacationshourly', function (Blueprint $table) {
            $table->dropForeign('FKvacationsh692359');
        });
    }
}
