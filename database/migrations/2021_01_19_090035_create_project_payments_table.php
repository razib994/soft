<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('project_id');
            $table->foreignId('category_id');
            $table->foreignId('bank_id')->nullable();
            $table->string('check_no')->nullable();
            $table->foreignId('item_name');
            $table->date('date');
            $table->double('amount');
            $table->string('payment_method')->nullable();
            $table->string('check_file')->nullable();
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
        Schema::dropIfExists('project_payments');
    }
}
