<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToDailytasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dailytasks', function (Blueprint $table) {
            $table->foreign(['employeeId'], 'FKdailytasks577353')->references(['id'])->on('employees');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dailytasks', function (Blueprint $table) {
            $table->dropForeign('FKdailytasks577353');
        });
    }
}
