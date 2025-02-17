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
        Schema::create('non_commercial_units', function (Blueprint $table) {
            $table->id();
            $table->foreignId('non_commercial_properties_id')->constrained()->onDelete('cascade');
            $table->string('unit_name');
            $table->integer('bedroom')->nullable();
            $table->integer('bath')->nullable();
            $table->integer('kitchen')->nullable();
            $table->integer('workspaces')->nullable(); // Only for offices
            $table->string('square_feet')->nullable();
            $table->string('amenities')->nullable();
            $table->enum('condition', ['new', 'good', 'fair', 'poor'])->nullable();
            $table->boolean('parking')->default(0);
            $table->boolean('sub_unit')->default(0);
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
        Schema::dropIfExists('non_commercial_units');
    }
};
