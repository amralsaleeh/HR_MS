<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('nationalnumber')->unique('nationalnumber');
            $table->string('fullname');
            $table->string('firsname');
            $table->string('lastname');
            $table->string('fathername');
            $table->string('mothername');
            $table->date('birthdate');
            $table->boolean('gender');
            $table->integer('positionid')->index('FKpositions650198');
            $table->integer('departmentid')->index('FKdepartmens839638');
            $table->integer('centerid')->index('FKcenters962608');
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
        Schema::dropIfExists('employees');
    }
}
