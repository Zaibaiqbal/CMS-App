<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMultipleColumnsToPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {

            $table->json('pass_no')->nullable()->after('net_weight');
            $table->double('passes_amount')->default(0)->nullable()->after('net_weight');
            $table->double('passes_weight')->default(0)->nullable()->after('net_weight');
            $table->double('received_amount')->default(0)->nullable()->after('amount');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn('pass_no');
            $table->dropColumn('passes_amount');
            $table->dropColumn('passes_weight');
            $table->dropColumn('received_amount');

        });
    }
}
