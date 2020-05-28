<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFinalSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('final_sales', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->nullable();
            $table->string('order_no',30)->nullable();
            $table->decimal('total_quantity',20,2)->nullable();
            $table->decimal('sub_total',20,2)->nullable();
            $table->decimal('fee',20,2)->nullable();
            $table->decimal('discount',20,2)->nullable();
            $table->decimal('final_total',20,2)->nullable();
            $table->decimal('paid_total',20,2)->nullable();
            $table->decimal('due_total',20,2)->nullable();
            $table->integer('payment_type_id')->nullable();
            $table->integer('payment_method_id')->nullable();
            $table->integer('account_id')->nullable();
            $table->string('payment_note',50)->nullable();
            $table->string('status',20)->nullable();
            $table->string('payment_status',20)->nullable();
            $table->string('delivery_note',50)->nullable();
            $table->string('delivery_status',20)->nullable();
            $table->string('return_request_status',20)->nullable();
            $table->decimal('return_quantity',20,2)->nullable();
            $table->string('sale_date',25)->nullable();
            $table->string('payment_date',25)->nullable();
            $table->integer('payment_received_by')->nullable();
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
        Schema::dropIfExists('final_sales');
    }
}
