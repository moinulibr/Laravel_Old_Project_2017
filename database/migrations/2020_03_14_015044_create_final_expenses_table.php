<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFinalExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('final_expenses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('expense_category_id')->nullable();
            $table->string('reference_no',30)->nullable();
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
            $table->string('payment_status',20)->nullable();
            $table->string('expense_date',25)->nullable();
            $table->string('payment_date',25)->nullable();
            $table->integer('payment_by')->nullable();
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
        Schema::dropIfExists('final_expenses');
    }
}
