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
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(); 
            $table->string('id_type')->nullable(); 
            $table->string('id_number')->nullable();
            $table->string('purpose')->nullable();
            $table->string('office_unit')->nullable();
            $table->time('entry_time')->nullable();
            $table->time('exit_time')->nullable(); 
            $table->date('visit_date')->nullable();
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
        Schema::dropIfExists('visitors');
    }
};
