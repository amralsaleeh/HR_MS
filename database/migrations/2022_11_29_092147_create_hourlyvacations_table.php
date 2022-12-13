<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHourlyvacationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hourlyvacations', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('employeeId')->index('FKhourlyvacations692359');
            $table->date('requestDate');
            $table->date('vacationDate');
            $table->time('from');
            $table->time('to');
            $table->time('duration');
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
        Schema::dropIfExists('hourlyvacations');
    }
}
