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
        Schema::create('tour_requests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname');
            $table->string('patronymic')->nullable();
            $table->string('email');
            $table->string('phone');
            $table->date('date_of_birth')->nullable();
            $table->string('applicant_type');
            $table->string('filename')->nullable();
            $table->string('file_type')->nullable();
            $table->string('type');
            $table->boolean('is_read')->default(false);
            $table->foreignId('tour_id')->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('tour_requests');
    }
};
