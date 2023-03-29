<?php

namespace Database\Seeders;

use App\Models\Cover;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CoverSeeder extends Seeder
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
        'slug' => 'service',
        'is_active' => false,
      ],
      [
        'slug' => 'tour',
        'is_active' => false,
      ],
      [
        'slug' => 'turkmenistan',
        'is_active' => false,
      ],
      [
        'slug' => 'about',
        'is_active' => false,
      ],
      [
        'slug' => 'contact',
        'is_active' => false,
      ],
    ];

    foreach ($arr as $item) {
      Cover::create($item);
    }
  }
}
