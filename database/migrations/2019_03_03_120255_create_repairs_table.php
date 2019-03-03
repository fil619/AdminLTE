<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepairsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repairs', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('billno');
          $table->integer('emp_id');
          $table->string('servicedetails');
          $table->double('servicecharge', 8, 2);
          $table->string('otherdetails');
          $table->double('othercharge', 8, 2);
          $table->dateTime('date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('repairs');
    }
}
