<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHourlytasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hourlytasks', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('employeeid')->index('FKhourlytasks833137');
            $table->date('requestdate');
            $table->date('taskdate');
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
        Schema::dropIfExists('hourlytasks');
    }
}
