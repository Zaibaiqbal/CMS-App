<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTruckAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('truck_assignments', function (Blueprint $table) {
            $table->increments('id');

            $table->bigInteger('client_id')->nullable();
            $table->bigInteger('truck_id')->nullable();
            $table->bigInteger('added_id')->nullable();
            $table->string('identifier')->nullable()->unique();


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
        Schema::dropIfExists('truck_assignments');
    }
}
