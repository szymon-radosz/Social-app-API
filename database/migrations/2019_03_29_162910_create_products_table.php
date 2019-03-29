<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //status -> 0 - aktywny 1 - zakonczony
        //state -> 0 - nowy 1 - uzywany
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->string('name')->nullable();
            $table->string('child_gender')->nullable();
            $table->double('price')->nullable();
            $table->double('lat')->nullable();
            $table->double('lng')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('state')->default(0);
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
        Schema::dropIfExists('products');
    }
}
