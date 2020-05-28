<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserRoleModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_role_modules', function (Blueprint $table) {
            $table->increments('id');
            $table->string('table_name',255)->nullable();
            $table->string('module_name',100)->nullable();
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
        Schema::dropIfExists('user_role_modules');
    }
}
