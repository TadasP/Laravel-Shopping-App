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
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('shop_id');
            $table->string('name');
            $table->string('slug');
            $table->float('price');
            $table->float('special_price')->nullable();
            $table->string('unit_id')->nullable();
            $table->float('weight')->nullable();
            $table->float('qty');
            $table->text('description');
            $table->string('img');
            $table->tinyInteger('active')->default('1');
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
