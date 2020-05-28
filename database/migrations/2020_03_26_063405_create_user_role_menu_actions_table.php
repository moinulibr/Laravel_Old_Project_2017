<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserRoleMenuActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_role_menu_actions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_role_menu_title_id')->nullable();
            $table->string('action_name',200)->nullable();
            $table->string('controller_name',200)->nullable();
            $table->string('action_checker_route_or_url',150)->unique()->nullable();
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
        Schema::dropIfExists('user_role_menu_actions');
    }
}
