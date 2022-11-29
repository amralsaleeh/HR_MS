<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTasksdailyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tasksdaily', function (Blueprint $table) {
            $table->foreign(['employeeid'], 'FKtasksdaily577353')->references(['id'])->on('employee');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tasksdaily', function (Blueprint $table) {
            $table->dropForeign('FKtasksdaily577353');
        });
    }
}
