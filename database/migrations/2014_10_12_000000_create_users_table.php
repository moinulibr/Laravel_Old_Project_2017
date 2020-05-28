<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            //$table->enum('user_type', ['official', 'client','supplier'])->nullable();
            $table->string('password');
            $table->integer('role_id')->nullable();
            $table->string('gender',10)->nullable();
            $table->string('phone',15)->unique()->nullable();
            $table->string('phone_2',15)->unique()->nullable();
            $table->string('phone_3',15)->unique()->nullable();
            $table->string('office_phone',15)->unique()->nullable();
            $table->string('office_phone_2',15)->unique()->nullable();
            $table->string('blood_group',20)->nullable();
            $table->string('religion',20)->nullable();
            $table->string('id_no',30)->unique()->nullable();
            $table->string('company_name',100)->nullable();
            $table->string('address',200)->nullable();
            //$table->string('department',100)->nullable();
            //$table->string('designation',100)->nullable();
            $table->string('image',5)->nullable();
            $table->string('bio',200)->nullable();
            $table->string('verified',25)->nullable();
            $table->string('is_deleted',25)->nullable();
            $table->integer('created_by')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
