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
            $table->string('fullName')->nullable();
            $table->string('nationalNumber')->unique('nationalNumber');
            $table->string('firstName');
            $table->string('fatherName');
            $table->string('lastName');
            $table->string('motherName');
            $table->string('degree')->nullable();
            $table->string('address')->nullable();
            $table->string('phoneNumber')->unique('phoneNumber');
            $table->string('birthAndPlace');
            $table->boolean('gender');
            $table->date('startDate');
            $table->date('quitDate')->nullable();
            $table->integer('isActive');
            $table->longText('notes')->nullable();
            $table->integer('earlyPositionId')->index('FKpositions650197')->nullable();
            $table->integer('positionId')->index('FKpositions650198')->nullable();
            $table->integer('departmentId')->index('FKdepartmens839638')->nullable();
            $table->integer('centerId')->index('FKcenters962608')->nullable();
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
