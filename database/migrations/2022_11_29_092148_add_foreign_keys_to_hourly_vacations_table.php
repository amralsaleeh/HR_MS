<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToHourlyvacationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hourly_vacations', function (Blueprint $table) {
            $table->foreign(['employeeId'], 'FK_hourly_vacations100')->references(['id'])->on('employees');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hourly_vacations', function (Blueprint $table) {
            $table->dropForeign('FK_hourly_vacations100');
        });
    }
}
