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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('prefix');
            $table->string('tag')->nullable();
            $table->string('added_by')->nullable();
            $table->date('purchase_date')->nullable();
            $table->unsignedBigInteger('main_propert_cat_id')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('manufacturer_id')->nullable();
            $table->unsignedBigInteger('condition_id');
            $table->unsignedBigInteger('property_id')->nullable();
            $table->unsignedBigInteger('unit_id')->nullable();
            $table->unsignedBigInteger('sub_unit_id')->nullable();
            $table->unsignedBigInteger('vendor_id')->nullable();
            $table->unsignedBigInteger('depreciation_class_id');
            $table->string('purchase_cost')->nullable();
            $table->string('currency')->nullable();
            $table->longtext('missing_description')->nullable();
            $table->enum('condition', ['best','good', 'fair'])->default('fair');
            $table->enum('movement_status', ['unallocated','allocated','moved'])->default('unallocated');
            $table->longtext('image')->nullable();
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
        Schema::dropIfExists('assets');
    }
};
