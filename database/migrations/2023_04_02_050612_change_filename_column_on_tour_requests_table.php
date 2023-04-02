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
        Schema::table('tour_requests', function (Blueprint $table) {
            $table->json('filename')->nullable()->change();
            $table->string('applicant_type')->nullable()->change();
        });

        Schema::table('service_requests', function (Blueprint $table) {
            $table->json('scanned_passport')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
