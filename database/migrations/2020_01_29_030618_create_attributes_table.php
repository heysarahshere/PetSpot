<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attributes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('pet_id'); // foreign on pets
            $table->string('friendly')->nullable(); // vague but common
            $table->string('good_with_kids')->nullable(); // sought-after trait
            $table->string('energetic')->nullable(); // opposite lazy
            $table->string('calm')->nullable(); // opposite aggressive
            $table->string('drools')->nullable();
            $table->string('vocal')->nullable();
            $table->string('trained')->nullable();
            $table->string('escape_artist')->nullable();
            $table->string('novice_owner_ok')->nullable();
            $table->string('aggressive_toward_humans')->nullable();
            $table->string('aggressive_toward_dogs')->nullable();
            $table->string('aggressive_toward_cats')->nullable();
            $table->string('aggressive_toward_kids')->nullable();
            $table->string('special_needs')->nullable();
            $table->string('shed_level')->nullable();
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
        Schema::dropIfExists('attributes');
    }
}
