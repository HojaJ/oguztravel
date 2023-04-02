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
        Schema::table('service_requests', function (Blueprint $table) {
            $table->enum('gender',['male','female'])->nullable()->after('patronymic');
        });
        Schema::table('people', function (Blueprint $table) {
            $table->enum('gender',['male','female'])->nullable()->after('patronymic');
        });
        Schema::table('tour_requests', function (Blueprint $table) {
            $table->enum('gender',['male','female'])->nullable()->after('patronymic');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('service_requests', function (Blueprint $table) {
            $table->dropColumn(['gender']);
        });
        Schema::table('people', function (Blueprint $table) {
            $table->dropColumn(['gender']);
        });
        Schema::table('tour_requests', function (Blueprint $table) {
            $table->dropColumn(['gender']);
        });
    }
};
