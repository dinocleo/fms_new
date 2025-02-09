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
        Schema::create('sub_units', function (Blueprint $table) {
            $table->id();
            $table->foreignId('non_commercial_unit_id')->constrained('non_commercial_units')->onDelete('cascade'); // Link to main unit
            $table->string('sub_unit_name');
            $table->integer('bedroom')->nullable();
            $table->integer('bath')->nullable();
            $table->integer('kitchen')->nullable();
            $table->integer('workspaces')->nullable(); // Only for offices
            $table->string('conference_room')->nullable(); // Only for offices
            $table->string('square_feet')->nullable();
            $table->string('amenities')->nullable();
            $table->string('condition')->nullable();
            $table->string('parking')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('sub_units');
    }
};
