<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
        Schema::create('detail_sales', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('final_sale_id')->nullable();
            $table->integer('client_id')->nullable();
            $table->string('order_no',30)->nullable();
            $table->integer('product_id')->nullable();
            $table->decimal('quantity',20,2)->nullable();
            $table->decimal('unit_price',20,2)->nullable();
            $table->decimal('sub_total',20,2)->nullable();
            $table->string('sale_date',25)->nullable();
            $table->string('description',100)->nullable();
            $table->string('sale_status',20)->nullable();
            $table->string('return_request_status',20)->nullable();
            $table->decimal('return_quantity',20,2)->nullable();
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
        Schema::dropIfExists('detail_sales');
    }
}
