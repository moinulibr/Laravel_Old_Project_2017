<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTotalSalePaymentHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
        Schema::create('total_sale_payment_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->nullable();
            $table->integer('final_sale_id')->nullable();
            $table->integer('payment_method_id')->nullable();
            $table->integer('account_id')->nullable();
            $table->string('order_no',30)->nullable();
            $table->decimal('paid_total',20,2)->nullable();
            $table->string('payment_date',25)->nullable();
            $table->string('short_note',50)->nullable();
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
        Schema::dropIfExists('total_sale_payment_histories');
    }
}
