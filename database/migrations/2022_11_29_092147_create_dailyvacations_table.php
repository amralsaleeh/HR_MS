<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailyvacationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dailyvacations', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('employeeId')->index('FKdailyvacations896395');
            $table->date('requestDate');
            $table->date('from');
            $table->date('to');
            $table->tinyInteger('duration');
            $table->tinyInteger('isAuthorization');
            $table->tinyInteger('type');
            $table->string('reason');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dailyvacations');
    }
}
