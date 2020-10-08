<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('image1_url', 500)->default('empty_cat.png');
            $table->string('image2_url', 500)->default('empty_cat.png');
            $table->string('image3_url', 500)->default('empty_cat.png');
            $table->text('description');
            $table->string('species');
            $table->string('gender')->nullable();
            $table->string('breed')->default('Breed Unknown');
            $table->string('size')->nullable();
            $table->string('status')->default('Pending');
//            $table->string('behavior'); // use behaviors table?
            $table->string('age')->default('Age Unknown');
            $table->integer('weight')->nullable();
            $table->string('fur_level')->nullable();
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
        Schema::dropIfExists('pets');
    }
}
