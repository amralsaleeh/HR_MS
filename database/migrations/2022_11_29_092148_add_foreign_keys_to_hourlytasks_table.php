<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToHourlytasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hourlytasks', function (Blueprint $table) {
            $table->foreign(['employeeId'], 'FKhourlytasks833137')->references(['id'])->on('employees');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hourlytasks', function (Blueprint $table) {
            $table->dropForeign('FKhourlytasks833137');
        });
    }
}
