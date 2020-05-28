<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailPurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
        Schema::create('detail_purchases', function (Blueprint $table) {
            $table->increments('id');
            $table->string('reference_no',30)->nullable();
            $table->integer('final_purchase_id')->nullable();
            $table->integer('supplier_id')->nullable();
            $table->integer('product_id')->nullable();
            $table->decimal('quantity',20,3)->nullable();
            $table->decimal('unit_price',20,2)->nullable();
            $table->decimal('total',20,2)->nullable();
            $table->string('purchase_date',25)->nullable();
            $table->string('description',100)->nullable();
            $table->string('return_request_status',20)->nullable();
            $table->decimal('return_quantity',20,2)->nullable();
            $table->integer('created_by')->nullable();
            $table->string('status',20)->nullable();
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
        Schema::dropIfExists('detail_purchases');
    }
}
