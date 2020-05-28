<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserRoleModuleActionPermitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_role_module_action_permitions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_role_module_action_id')->nullable();
            $table->integer('role_id')->nullable();
            $table->string('is_active',1)->default('1')->nullable();
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
        Schema::dropIfExists('user_role_module_action_permitions');
    }
}
