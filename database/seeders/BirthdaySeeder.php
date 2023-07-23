<?php

namespace Database\Seeders;

use App\Models\BirthdayMessage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BirthdaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = [
            [
                'name' => 'Birthday',
                'en' => 'Happy Birthday',
                'tm' => 'Happy Birthday',
                'ru' => 'Happy Birthday',
                'zh' => 'Happy Birthday',
            ],
        ];

        foreach ($arr as $item) {
            BirthdayMessage::create($item);
        }
    }
}
