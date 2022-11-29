<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksdailyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasksdaily', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('employeeid')->index('FKtasksdaily577353');
            $table->date('duration');
            $table->date('from');
            $table->date('to');
            $table->date('requestdate');
            $table->string('reason');
            $table->integer('type');
            $table->integer('isauthorization');
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
        Schema::dropIfExists('tasksdaily');
    }
}
