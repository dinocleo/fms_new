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
        Schema::table('non_commercial_properties', function (Blueprint $table) {
            $table->unsignedBigInteger('maintainer_id')->nullable();
            $table->unsignedBigInteger('owner_user_id')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('non_commercial_properties', function (Blueprint $table) {
            $table->dropColumn('maintainer_id');
            $table->dropColumn('owner_user_id');
        });
    }
};
