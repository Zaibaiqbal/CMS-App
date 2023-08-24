<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->increments('id');
            $table->unsignedInteger('client_id')->nullable();
            $table->string('name')->nullable();
            $table->string('cnic')->nullable();
            $table->string('email')->unique();
            $table->string('contact')->nullable();
            $table->string('user_type')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('account_type')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->enum('status',['Active','Inactive'])->default('Inactive');
            $table->integer('is_deleted')->default(0);

            $table->integer('is_verified')->default(0);
            $table->string('verification_token')->nullable();

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
