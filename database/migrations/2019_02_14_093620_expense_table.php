<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ExpenseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('expenses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->string('ledger');
            $table->integer('amount');
            $table->date('date');
            $table->text('narration');
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
      Schema::dropIfExists('expenses');
    }
}
