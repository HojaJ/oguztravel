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
        $data = [
            ['title' => '{"en": "Ticket", "ru": "Ticket", "tm": "Ticket", "zh": "Ticket"}', 'email' => 'ticket@oguztravel.com'],
            ['title' => '{"en": "Hotel", "ru": "Hotel", "tm": "Hotel", "zh": "Hotel"}', 'email' => 'hotel@oguztravel.com'],
            ['title' => '{"en": "Translate", "ru": "Translate", "tm": "Translate", "zh": "Translate"}', 'email' => 'translate@oguztravel.com'],
            ['title' => '{"en": "World Tours", "ru": "World Tours", "tm": "World Tours", "zh": "World Tours"}', 'email' => 'outb@oguztravel.com'],
            ['title' => '{"en": "Turkmen Tours", "ru": "Turkmen Tours", "tm": "Turkmen Tours", "zh": "Turkmen Tours"}', 'email' => 'inb@oguztravel.com'],
            ['title' => '{"en": "Others", "ru": "Others", "tm": "Others", "zh": "Others"}', 'email' => 'info@oguztravel.com'],
        ];
        Schema::table('subjects', function (Blueprint $table) {
            $table->string('email')->nullable()->after('title');
        });
        \App\Models\Subject::insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subjects', function (Blueprint $table) {
            $table->dropColumn('email');
        });
    }
};
