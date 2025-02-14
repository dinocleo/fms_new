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
        Schema::create('non_commercial_sub_units', function (Blueprint $table) {
            $table->id();
            $table->foreignId('non_commercial_unit_id')
                ->constrained('non_commercial_units')
                ->onDelete('cascade');
            $table->string('unit_name');
            $table->text('amenities')->nullable();
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
        Schema::dropIfExists('non_commercial_sub_units');
    }
};
