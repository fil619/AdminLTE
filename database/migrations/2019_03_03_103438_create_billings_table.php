<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billings', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('billno');
            $table->dateTime('date');
            $table->integer('emp_id');
            $table->double('total');
            $table->double('gsttotal');
            $table->double('discount');
            $table->double('grandtotal');
            $table->double('advance');
            $table->double('balance');
            $table->double('given');
            $table->double('returnable');
            $table->string('type');
            $table->string('transaction');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('billings');
    }
}
