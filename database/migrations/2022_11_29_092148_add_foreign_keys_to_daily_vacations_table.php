<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToDailyvacationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('daily_vacations', function (Blueprint $table) {
            $table->foreign(['employeeId'], 'FK_daily_vacations100')->references(['id'])->on('employees');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('daily_vacations', function (Blueprint $table) {
            $table->dropForeign('FK_daily_vacations100');
        });
    }
}
