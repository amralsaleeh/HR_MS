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
        Schema::table('dailyvacations', function (Blueprint $table) {
            $table->foreign(['employeeid'], 'FKdailyvacations896395')->references(['id'])->on('employees');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dailyvacations', function (Blueprint $table) {
            $table->dropForeign('FKdailyvacations896395');
        });
    }
}
