<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVacationshourlyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacationshourly', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('employeeid')->index('FKvacationsh692359');
            $table->time('duration');
            $table->time('from');
            $table->time('to');
            $table->date('requestdate');
            $table->date('vacationdate');
            $table->string('reason');
            $table->integer('type');
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
        Schema::dropIfExists('vacationshourly');
    }
}
