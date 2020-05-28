<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTotalBillPaymentHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {  
        Schema::create('total_bill_payment_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('supplier_id')->nullable();
            $table->integer('final_purchase_id')->nullable();
            $table->integer('payment_method_id')->nullable();
            $table->integer('account_id')->nullable();
            $table->string('reference_no',30)->nullable();
            $table->decimal('paid_total',20,2)->nullable();
            $table->string('payment_date',25)->nullable();
            $table->string('status',20)->nullable();
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
        Schema::dropIfExists('total_bill_payment_histories');
    }
}
