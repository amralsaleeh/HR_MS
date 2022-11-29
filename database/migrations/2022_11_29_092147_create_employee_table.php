<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('nationalnumber')->unique('nationalnumber');
            $table->string('fullname');
            $table->string('firsname');
            $table->string('lastname');
            $table->string('fathername');
            $table->string('mothername')->nullable();
            $table->date('birthdate');
            $table->boolean('gender');
            $table->integer('positionid')->index('FKemployee650198');
            $table->integer('departmentid')->index('FKemployee839638');
            $table->integer('centerid')->index('FKemployee962608');
            $table->date('startdate');
            $table->integer('phonenumber');
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
        Schema::dropIfExists('employee');
    }
}
