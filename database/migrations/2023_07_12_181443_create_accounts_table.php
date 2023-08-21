<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->string('title')->nullable();
            $table->unsignedInteger('added_id')->nullable();
            $table->string('account_no')->nullable();
            $table->string('client_group')->nullable();
            $table->enum('approval_status',['Requested','Approved'])->default('Requested');

            $table->enum('status',['Inactive','Active','Suspended'])->default('Inactive');

            $table->integer('is_deleted')->default(0);

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
