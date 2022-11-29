<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskshourlyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taskshourly', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('employeeid')->index('FKtaskshourl833137');
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
        Schema::dropIfExists('taskshourly');
    }
}
