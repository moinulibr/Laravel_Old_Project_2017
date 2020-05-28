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
            //$table->enum('product_type',['goods','service'])->nullable();
            $table->string('product_type',50)->nullable();
            $table->string('name',150)->unique()->nullable();
            $table->integer('product_category_id')->nullable();
            $table->integer('sub_category_id')->nullable(); 
            $table->integer('unit_id')->nullable(); 
            $table->string('sku',100)->nullable();

            /*delete when it will be added enventory management*/
            $table->decimal('purchase_unit_price',20,2)->nullable(); 
            $table->decimal('sale_unit_price',20,2)->nullable(); 
            $table->decimal('profit_unit_price',20,2)->nullable();
            $table->decimal('quantity',20,3)->nullable();
            /*delete when it will be added enventory management*/

            $table->string('barcode_type',50)->nullable();
            $table->string('barcode',150)->nullable();
            $table->decimal('alert_quantity',20,2)->nullable(); 
            $table->string('expiry_period',50)->nullable();
            $table->string('expiry_period_type',50)->nullable();
            $table->string('weight',50)->nullable();
            $table->string('return_allowed',10)->nullable();
            $table->string('product_description',200)->nullable();
            $table->string('product_variation_type',50)->nullable();
            $table->string('image',5)->nullable();
            $table->integer('created_by')->nullable();
            $table->string('verified',25)->nullable();
            $table->string('is_deleted',25)->nullable();
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
