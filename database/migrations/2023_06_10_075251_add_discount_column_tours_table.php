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
        // remove tables from vouchers table
        Schema::dropIfExists(config('vouchers.relation_table', 'user_voucher'));
        Schema::dropIfExists(config('vouchers.table', 'vouchers'));


        Schema::table('tours', function (Blueprint $table) {
            $table->text('discount_percent')->nullable()->after('price');
            $table->dateTime('discount_end_time')->nullable()->after('price');
            $table->boolean('discount_active')->nullable()->after('price')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tours', function (Blueprint $table) {
            $table->dropColumn('discount_percent','discount_end_time','discount_active');
        });
    }
};
