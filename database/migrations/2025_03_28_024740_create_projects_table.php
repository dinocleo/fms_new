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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('budget', 10, 2);
            $table->enum('priority', ['Low', 'Medium', 'High']);
            $table->enum('status', ['ongoing', 'completed', 'pending', 'terminated']);
            // Foreign keys for contractors and properties
            $table->unsignedBigInteger('contractor_id')->nullable();
            $table->unsignedBigInteger('property_id')->nullable();
            $table->unsignedBigInteger('non_commercial_property_id')->nullable();
            $table->string('documents')->nullable();
            $table->timestamps();

            // Foreign Key Constraints
            $table->foreign('contractor_id')->references('id')->on('contractors')->onDelete('cascade');
            $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade');
            $table->foreign('non_commercial_property_id')->references('id')->on('non_commercial_properties')->onDelete('cascade');      
          });
                }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
};
