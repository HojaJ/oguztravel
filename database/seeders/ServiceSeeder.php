<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ServiceSeeder extends Seeder
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
        'slug' => 'visa',
        'title' => [
          'en' => 'Visa',
          'tm' => 'Visa',
          'ru' => 'Visa',
          'zh' => 'Visa',
        ],
        'subtitle' => [
          'en' => 'Id mea congue dictas, nec et summo mazim impedit. Vim te audiam impetus interpretaris.',
          'tm' => 'Id mea congue dictas, nec et summo mazim impedit. Vim te audiam impetus interpretaris.',
          'ru' => 'Id mea congue dictas, nec et summo mazim impedit. Vim te audiam impetus interpretaris.',
          'zh' => 'Id mea congue dictas, nec et summo mazim impedit. Vim te audiam impetus interpretaris.',
        ],
        'is_active' => false,
      ],
      [
        'slug' => 'ticket',
        'title' => [
          'en' => 'Ticket',
          'tm' => 'Ticket',
          'ru' => 'Ticket',
          'zh' => 'Ticket',
        ],
        'subtitle' => [
          'en' => 'Id mea congue dictas, nec et summo mazim impedit. Vim te audiam impetus interpretaris.',
          'tm' => 'Id mea congue dictas, nec et summo mazim impedit. Vim te audiam impetus interpretaris.',
          'ru' => 'Id mea congue dictas, nec et summo mazim impedit. Vim te audiam impetus interpretaris.',
          'zh' => 'Id mea congue dictas, nec et summo mazim impedit. Vim te audiam impetus interpretaris.',
        ],
        'is_active' => false,
      ],
      [
        'slug' => 'hotel',
        'title' => [
          'en' => 'Hotel',
          'tm' => 'Hotel',
          'ru' => 'Hotel',
          'zh' => 'Hotel',
        ],
        'subtitle' => [
          'en' => 'Id mea congue dictas, nec et summo mazim impedit. Vim te audiam impetus interpretaris.',
          'tm' => 'Id mea congue dictas, nec et summo mazim impedit. Vim te audiam impetus interpretaris.',
          'ru' => 'Id mea congue dictas, nec et summo mazim impedit. Vim te audiam impetus interpretaris.',
          'zh' => 'Id mea congue dictas, nec et summo mazim impedit. Vim te audiam impetus interpretaris.',
        ],
        'is_active' => false,
      ],
      [
        'slug' => 'translation',
        'title' => [
          'en' => 'Translation',
          'tm' => 'Translation',
          'ru' => 'Translation',
          'zh' => 'Translation',
        ],
        'subtitle' => [
          'en' => 'Id mea congue dictas, nec et summo mazim impedit. Vim te audiam impetus interpretaris.',
          'tm' => 'Id mea congue dictas, nec et summo mazim impedit. Vim te audiam impetus interpretaris.',
          'ru' => 'Id mea congue dictas, nec et summo mazim impedit. Vim te audiam impetus interpretaris.',
          'zh' => 'Id mea congue dictas, nec et summo mazim impedit. Vim te audiam impetus interpretaris.',
        ],
        'is_active' => false,
      ],
    ];

    foreach ($arr as $item) {
      Service::create($item);
    }
  }
}
