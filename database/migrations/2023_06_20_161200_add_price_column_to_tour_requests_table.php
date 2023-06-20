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
            $table->float('price')->nullable()->after('filename');
            $table->float('discount_price')->nullable()->after('filename');
            $table->text('discount_percent')->nullable()->after('filename');
            $table->dateTime('discount_end_time')->nullable()->after('filename');
            $table->boolean('discount_active')->nullable()->after('filename')->default(false);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tour_requests', function (Blueprint $table) {
            $table->dropColumn('price','discount_price','discount_percent','discount_end_time','discount_active');
        });
    }
};
