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
            $table->string('fullname')->nullable();
            $table->string('nationalnumber')->unique('nationalnumber');
            $table->string('firstname');
            $table->string('fathername');
            $table->string('lastname');
            $table->string('mothername');
            $table->string('phonenumber')->unique('phonenumber');
            $table->date('birthdate');
            $table->date('startdate');
            $table->boolean('gender');
            $table->integer('isactive');
            $table->integer('positionid')->index('FKpositions650198')->nullable();;
            $table->integer('departmentid')->index('FKdepartmens839638')->nullable();;
            $table->integer('centerid')->index('FKcenters962608')->nullable();;
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
