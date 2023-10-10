<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrucksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trucks', function (Blueprint $table) {
            $table->increments('id');
            // $table->bigInteger('client_id')->nullable();
            // $table->bigInteger('added_id')->nullable();

            $table->string('plate_no')->nullable();
            $table->string('model')->nullable();
            $table->string('color')->nullable();
            $table->string('company')->nullable();
            $table->string('vin_no')->nullable();

            $table->double('tare_weight')->default(0);
            $table->string('unit')->nullable();
            $table->longText('description')->nullable();
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
        Schema::dropIfExists('trucks');
    }
}
