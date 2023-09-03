<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('from_user_id')->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->json('to_user_id')->nullable(); // BIG INTEGER IDS
            $table->integer('params')->default(0)->nullable();
            $table->integer('params2')->default(0)->nullable();
            $table->string('type')->nullable();
            $table->string('route')->nullable();
            $table->string('message')->nullable();
            $table->integer('is_appear')->default(0)->nullable(); // ON MENU OPEN
            $table->integer('is_seen')->default(0)->nullable();   // ON HOVER
            $table->integer('is_visit')->default(0)->nullable();  // ONCLICK
            $table->json('logs')->nullable();
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
        Schema::dropIfExists('notifications');
    }
}
