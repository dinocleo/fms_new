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
        Schema::table('energy_management', function (Blueprint $table) {
            $table->unsignedBigInteger('property_id')->nullable(); // Add the column without the constraint for now
            $table->unsignedBigInteger('non_commercial_property_id')->nullable();
            $table->foreign('property_id')->references('id')->on('properties')->onDelete('set null');
            $table->foreign('non_commercial_property_id')->references('id')->on('non_commercial_properties')->onDelete('set null');
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('energy_management', function (Blueprint $table) {
            //
        });
    }
};
