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
        Schema::create('non_commercial_properties', function (Blueprint $table) {
            $table->id();
            $table->enum('property_type', ['office', 'resident']);
            $table->string('name')->nullable();
            $table->string('region')->nullable();
            $table->string('district')->nullable();
            $table->string('street')->nullable();
            $table->text('description')->nullable();
            $table->integer('number_of_units')->nullable(); // For Office
            $table->integer('number_of_unit')->nullable(); // For Resident
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
        Schema::dropIfExists('non_commercial_properties');
    }
};
