<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('client_id')->nullable();
            $table->unsignedInteger('added_id')->nullable();
            $table->unsignedInteger('material_type_id')->nullable();
            $table->unsignedInteger('truck_id')->nullable();
            $table->unsignedInteger('account_id')->nullable();
            $table->unsignedInteger('driver_id')->nullable();
            $table->string('ticket_no')->nullable();
            $table->string('job_id')->nullable();

            $table->string('client_group')->nullable();
            $table->string('operation_type')->nullable();

            $table->string('plate_no')->nullable();
            $table->string('client_name')->nullable();
            $table->string('contact_no')->nullable();

            $table->double('gross_weight')->default(0);
            $table->string('weight_unit')->nullable();
            $table->double('tare_weight')->default(0);
            $table->double('net_weight')->default(0);

            $table->double('material_rate')->default(0);
            
            $table->text('note')->nullable();
            $table->text('vehicle_desc')->nullable();
            $table->timestamp('date')->nullable();
            $table->enum('status', ['Queued','Processed'])->default('Queued');
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
        Schema::dropIfExists('transactions');
    }
}
