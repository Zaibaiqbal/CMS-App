<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurchargeHstPercentageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surcharge_hst_percentage', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('client_id')->nullable();

            $table->double('surcharge_per')->nullable()->default(0);
            $table->double('hst_per')->nullable()->default(0);
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
        Schema::dropIfExists('surcharge_hst_percentage');
    }
}
