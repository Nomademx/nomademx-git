<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('suburbs', function (Blueprint $table) {
            $table->integer('sale_m2')->nullable();
            $table->integer('pre_sale_m2')->nullable();
            $table->integer('total_population')->nullable();
            $table->integer('total_male')->nullable();
            $table->integer('total_female')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('suburbs', function (Blueprint $table) {
            $table->dropColumn('sale_m2');
            $table->dropColumn('pre_sale_m2');
            $table->dropColumn('total_population');
            $table->dropColumn('total_male');
            $table->dropColumn('total_female');
        });
    }
};
