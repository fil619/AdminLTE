<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
          $table->increments('id');
            $table->string('employee_id');
            $table->string('company_code');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('dob');
            $table->string('address');
            $table->string('telephone')->nullable();;
            $table->string('phone_no');
            $table->string('email')->nullable();;
            $table->string('adhar')->nullable();;
            $table->string('type');
            $table->string('password');
            $table->string('joined_on');
            $table->string('left_on')->nullable();;
            $table->timestamps();
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
