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
        Schema::create('energy_management', function (Blueprint $table) {
            $table->id();
            // $table->date('date');
            $table->string('month', 7);
            $table->string('utility_type'); // electricity, fuel, water
            $table->decimal('consumption', 12, 2);
            $table->decimal('cost', 12, 2);
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('energy_management');
    }
};
