<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('transaction_id');
            $table->double('rate')->default(0)->nullable();
            $table->double('quantity')->default(0)->nullable();
            $table->double('amount')->default(0)->nullable();
            $table->double('tax_amount')->default(0)->nullable();
            $table->double('surcharge_amount')->default(0)->nullable();
            $table->string('mode_of_payment')->nullable();
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
        Schema::dropIfExists('payments');
    }
}
