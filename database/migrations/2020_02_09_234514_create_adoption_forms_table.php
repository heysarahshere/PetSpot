<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdoptionFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('adoption_forms', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->timestamps();
            $table->integer('user_id')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('address_line_1');
            $table->string('address_line_2')->nullable();
            $table->string('city');;
            $table->string('state');
            $table->string('zip');
            $table->string('email');
            $table->string('phone');
            $table->string('answer_1');
            $table->string('answer_2');
            $table->string('answer_3');
            $table->string('urgency');
            $table->string('pet_name')->default('Any Pet');
            $table->integer('pet_id')->default(0);
            $table->string('status')->default('Pending');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adoption_forms');
    }
}
