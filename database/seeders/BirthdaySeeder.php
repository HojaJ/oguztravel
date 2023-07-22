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
                'lang' => 'ru',
                'content' => 'Happy Birthday',
            ],
            [
                'lang' => 'en',
                'content' => 'Happy Birthday',
            ],
            [
                'lang' => 'tm',
                'content' => 'Happy Birthday',
            ],
            [
                'lang' => 'zh',
                'content' => 'Happy Birthday',
            ]
        ];

        foreach ($arr as $item) {
            BirthdayMessage::create($item);
        }
    }
}
