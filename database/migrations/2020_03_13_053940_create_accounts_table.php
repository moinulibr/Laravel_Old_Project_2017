<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->increments('id');
            //$table->enum('account_type', ['cash', 'mobile banking','bank','online banking'])->nullable();
            $table->integer('account_for_user_id')->nullable();
            $table->integer('payment_method_id')->nullable();
            $table->integer('mobile_banking_type_id')->nullable();
            $table->string('account_name',100)->nullable();
            $table->string('account_no',50)->nullable();
            $table->string('bank_name',100)->nullable();
            $table->string('bank_address',200)->nullable();
            $table->decimal('amount',20,2)->default(0.00);
            $table->string('status',20)->nullable();
            $table->string('verified',25)->nullable();
            $table->string('is_deleted',25)->nullable();
            $table->integer('created_by')->nullable();
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
        Schema::dropIfExists('accounts');
    }
}
