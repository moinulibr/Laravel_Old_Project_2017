<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestDetailsTypiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_details_typies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('test_id')->nullable();
            $table->integer('test_details_id')->nullable();
            $table->integer('input_type_id')->nullable();
            $table->string('test_details_name',255)->nullable();
            
            $table->string('test_name',255)->nullable();
  

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
        Schema::dropIfExists('test_details_typies');
    }
}
