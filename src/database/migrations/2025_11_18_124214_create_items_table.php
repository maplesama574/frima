<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    public function up(): void
{
    Schema::create('items', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id');
        $table->string('name');
        $table->string('brand')->nullable();     
        $table->text('description');
        $table->integer('price');
        $table->string('image_path');
        $table->string('condition');
        $table->string('category')->nullable();
        $table->timestamps();

        $table->foreign('user_id')
              ->references('id')
              ->on('users')
              ->onDelete('cascade');
    });
}


    public function down():void
    {
        Schema::dropIfExists('items');
    }
}
