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
        Schema::table('hourlyvacations', function (Blueprint $table) {
            $table->foreign(['employeeId'], 'FKhourlyvacations692359')->references(['id'])->on('employees');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hourlyvacations', function (Blueprint $table) {
            $table->dropForeign('FKhourlyvacations692359');
        });
    }
}
