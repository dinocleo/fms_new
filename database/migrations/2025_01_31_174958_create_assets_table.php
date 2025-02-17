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
            // $table->string('prefix');
            $table->string('tag')->nullable();
            $table->string('added_by')->nullable();
            $table->date('purchase_date')->nullable();
            $table->string('status_id');
            $table->string('category_id');
            $table->string('main_propert_cat_id')->nullable();
            $table->string('manufacturer_id')->nullable();
            $table->string('condition_id');
            $table->string('property_id')->nullable();
            $table->string('unit_id')->nullable();
            $table->string('sub_unit_id')->nullable();
            $table->string('vendor_id')->nullable();
            $table->string('depreciation_class_id');
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
