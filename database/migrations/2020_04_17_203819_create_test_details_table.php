<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('test_id')->nullable();
            $table->string('label',255)->nullable();
            $table->string('name',255)->nullable();
            $table->string('field_name',255)->nullable();#no need
            $table->string('input_type',30)->nullable();
            $table->integer('input_type_id')->nullable();
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
        Schema::dropIfExists('test_details');
    }
}
