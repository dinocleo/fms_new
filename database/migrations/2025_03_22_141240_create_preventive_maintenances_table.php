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
        Schema::create('preventive_maintenances', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('property_id')->nullable();
            $table->string('unit_id')->nullable();
            $table->string('sub_unit_id')->nullable();
            $table->string('issue_id')->nullable();
            $table->string('multiple_date')->nullable();
            $table->string('monthly_recurring')->nullable();
            $table->string('general_recurring')->nullable();
            $table->string('decription')->nullable();
            $table->enum('status', ['pending_approval', 'on_going', 'cancelled', 'complete'])->default('pending_approval');
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
        Schema::dropIfExists('preventive_maintenances');
    }
};
