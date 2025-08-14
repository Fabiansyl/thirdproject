<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    
    Schema::create('cart', function (Blueprint $table) {
        $table->id();
        $table->string('name', 200);
        $table->string('image', 200)->nullable();
        $table->string('price', 20);
        $table->integer('qty');
        $table->unsignedBigInteger('prod_id');
        $table->unsignedBigInteger('user_id');
        $table->timestamps();

        $table->foreign('prod_id')->references('id')->on('products')->onDelete('cascade');
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    Schema::dropIfExists('cart');
    }

}
