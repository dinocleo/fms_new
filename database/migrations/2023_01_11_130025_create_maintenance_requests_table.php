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
        Schema::create('maintenance_requests', function (Blueprint $table) {
            $table->bigIncrements('id'); // Explicitly make 'id' auto-incrementing
            $table->unsignedBigInteger('property_id');
            $table->unsignedBigInteger('unit_id')->nullable();
            $table->unsignedBigInteger('owner_user_id')->nullable();
            $table->unsignedBigInteger('issue_id');
            $table->longText('details')->nullable();
            $table->tinyInteger('status')->default(MAINTENANCE_REQUEST_STATUS_PENDING);
            $table->unsignedBigInteger('attach_id')->nullable();
            $table->unsignedBigInteger('ticket_id')->nullable();
            $table->unsignedBigInteger('invoice_id')->nullable();
            $table->decimal('amount')->default(0);
            $table->date('created_date');
            $table->date('resolved_date');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('maintenance_requests');
    }
};
