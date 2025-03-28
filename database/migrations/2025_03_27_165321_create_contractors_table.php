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
        Schema::create('contractors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('company');
            $table->string('category');
            $table->string('license_number')->nullable();
            $table->date('contract_start')->nullable();
            $table->date('contract_end')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('service_provided')->nullable();
            $table->enum('status', ['ongoing', 'completed', 'pending', 'terminated'])->default('ongoing');
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
        Schema::dropIfExists('contractors');
    }
};
