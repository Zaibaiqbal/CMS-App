<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMultipleColumnsToMaterialTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('material_types', function (Blueprint $table) {
           $table->double('slab_rate')->default(0)->nullable();
           $table->double('slab_weight')->default(0)->nullable();
           $table->double('weight_break')->default(0)->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('material_types', function (Blueprint $table) {
            $table->dropColumn('slab_rate');
            $table->dropColumn('slab_weight');
            $table->dropColumn('weight_break');
            
        });
    }
}
