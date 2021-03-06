<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone');
            $table->string('area')->nullable();
            $table->string('land')->nullable();
            $table->string('width')->nullable();
            $table->string('height')->nullable();
            $table->text('store')->nullable();
            $table->string('building')->nullable();
            $table->string('demand')->nullable();
            $table->foreignId('profession_id');
            $table->text('organization')->nullable();
            $table->date('date');
            $table->text('remark')->nullable();
            $table->text('report')->nullable();
            $table->string('contact_person')->nullable();;
            $table->string('check_file')->nullable();;
            $table->string('check_file_one')->nullable();;
            $table->string('check_file_two')->nullable();;
            $table->string('address')->nullable();;
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
        Schema::dropIfExists('visitors');
    }
}
