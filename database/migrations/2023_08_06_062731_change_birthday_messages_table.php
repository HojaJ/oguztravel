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
        if (Schema::hasColumn('birthday_messages', 'tm'))
        {
            Schema::table('birthday_messages', function (Blueprint $table)
            {
                $table->dropColumn('tm');
            });
        }
        if (Schema::hasColumn('birthday_messages', 'ru'))
        {
            Schema::table('birthday_messages', function (Blueprint $table)
            {
                $table->dropColumn('ru');
            });
        }
        if (Schema::hasColumn('birthday_messages', 'en'))
        {
            Schema::table('birthday_messages', function (Blueprint $table)
            {
                $table->dropColumn('en');
            });
        }
        if (Schema::hasColumn('birthday_messages', 'zh'))
        {
            Schema::table('birthday_messages', function (Blueprint $table)
            {
                $table->dropColumn('zh');
            });
        }
        Schema::table('birthday_messages', function (Blueprint $table) {
            $table->string('lang');
            $table->text('content');
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
