<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToVacationsdailyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vacationsdaily', function (Blueprint $table) {
            $table->foreign(['employeeid'], 'FKvacationsd896395')->references(['id'])->on('employee');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vacationsdaily', function (Blueprint $table) {
            $table->dropForeign('FKvacationsd896395');
        });
    }
}
