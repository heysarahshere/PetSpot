<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->integer('user_id')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('line_1');
            $table->string('line_2')->nullable();
            $table->string('city');;
            $table->string('state');
            $table->string('zip');
            $table->string('email');
            $table->string('phone');
            $table->string('note')->nullable();
            $table->string('honor')->nullable();
            $table->string('creditCardNumber');
            $table->string('creditCardType');
            $table->string('creditCardMonth');
            $table->string('creditCardYear');
            $table->string('creditCardCode');
            $table->string('plan');
            $table->string('amount');
            $table->string('status')->default('Active');
            $table->datetime('end_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('donations');
    }
}
