<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvestExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invest_expenses', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('investor_id');
            $table->foreignId('bank_id')->nullable();
            $table->string('check_no')->nullable();
            $table->date('date');
            $table->double('amount');
            $table->string('payment_method')->nullable();
            $table->text('note')->nullable();
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
        Schema::dropIfExists('invest_expenses');
    }
}
