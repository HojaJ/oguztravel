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
        Schema::create('service_requests', function (Blueprint $table) {
            $table->id();
            $table->string('applicant_type')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->date('booking_date_from')->nullable();
            $table->date('booking_date_to')->nullable();
            $table->string('room_type')->nullable();
            $table->string('adult_qty')->nullable();
            $table->string('child_qty')->nullable();
            $table->string('ticket_from')->nullable();
            $table->string('ticket_to')->nullable();
            $table->string('ticket_type')->nullable();
            $table->date('boarding_date_from')->nullable();
            $table->date('boarding_date_to')->nullable();
            $table->date('planned_date_from')->nullable();
            $table->date('planned_date_to')->nullable();
            $table->string('name');
            $table->string('surname');
            $table->string('patronymic')->nullable();
            $table->string('email');
            $table->string('phone');
            $table->date('date_of_birth')->nullable();
            $table->string('passport_info_type')->nullable();
            $table->string('passport_number')->nullable();
            $table->date('expiry_date')->nullable();
            $table->string('scanned_passport')->nullable();
            $table->string('scanned_passport_file_type')->nullable();
            $table->string('note')->nullable();
            $table->string('type');
            $table->boolean('is_read')->default(false);
            $table->softDeletes();
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
        Schema::dropIfExists('service_requests');
    }
};
