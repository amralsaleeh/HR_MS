<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTaskshourlyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('taskshourly', function (Blueprint $table) {
            $table->foreign(['employeeid'], 'FKtaskshourl833137')->references(['id'])->on('employee');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('taskshourly', function (Blueprint $table) {
            $table->dropForeign('FKtaskshourl833137');
        });
    }
}
