<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_expenses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('final_expense_id')->nullable();
            $table->string('reference_no',30)->nullable();
            $table->string('expense_title',150)->nullable();
            $table->string('description',200)->nullable();
            $table->decimal('final_total',20,2)->nullable();
            $table->string('expense_created_date',25)->nullable();
            $table->integer('expense_by')->nullable();
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
        Schema::dropIfExists('detail_expenses');
    }
}
