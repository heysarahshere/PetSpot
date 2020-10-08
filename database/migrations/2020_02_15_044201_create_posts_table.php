<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id')->nullable();
            $table->timestamps();
            $table->string('title');
            $table->string('author')->default('Anonymous');
            $table->string('contact_email')->nullable();
            $table->string('content', 10000);
            $table->string('category');
            $table->string('img', 500)->nullable();
            $table->string('address_address')->nullable();
            $table->string('state')->nullable();
            $table->date('event_date')->nullable();
            $table->string('type')->default('other');
            $table->double('address_latitude')->nullable();
            $table->double('address_longitude')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
