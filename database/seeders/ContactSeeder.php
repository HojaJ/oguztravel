<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ContactSeeder extends Seeder
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
        'slug' => 'address',
        'locale_data' => [
          'en' => 'Aşgabat ş. G.Gulyýew köçesi, jaý 87 (Nurana bina), 2-nji gat',
          'tm' => 'Aşgabat ş. G.Gulyýew köçesi, jaý 87 (Nurana bina), 2-nji gat',
          'ru' => 'Aşgabat ş. G.Gulyýew köçesi, jaý 87 (Nurana bina), 2-nji gat',
          'zh' => 'Aşgabat ş. G.Gulyýew köçesi, jaý 87 (Nurana bina), 2-nji gat',
        ],
        'type' => 'address',
        'icon' => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 13.4299C13.7231 13.4299 15.12 12.0331 15.12 10.3099C15.12 8.58681 13.7231 7.18994 12 7.18994C10.2769 7.18994 8.88 8.58681 8.88 10.3099C8.88 12.0331 10.2769 13.4299 12 13.4299Z" stroke="#292D32" stroke-width="1.5"/><path d="M3.62001 8.49C5.59001 -0.169998 18.42 -0.159997 20.38 8.5C21.53 13.58 18.37 17.88 15.6 20.54C13.59 22.48 10.41 22.48 8.39001 20.54C5.63001 17.88 2.47001 13.57 3.62001 8.49Z" stroke="#292D32" stroke-width="1.5"/></svg>'
      ],
      [
        'slug' => 'copyright',
        'locale_data' => [
          'en' => '2022 &copy; Oguz travel',
          'tm' => '2022 &copy; Oguz travel',
          'ru' => '2022 &copy; Oguz travel',
          'zh' => '2022 &copy; Oguz travel',
        ],
        'type' => 'copyright',
      ],
      [
        'slug' => 'work_phone_1',
        'data' => '+993 12 75 37 07',
        'type' => 'contact',
        'icon' => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12.5 22.0001H4.07997C2.91997 22.0001 1.96997 21.0701 1.96997 19.9301V5.09011C1.96997 2.47011 3.91997 1.2801 6.30997 2.4501L10.75 4.63011C11.71 5.10011 12.5 6.3501 12.5 7.4101V22.0001Z" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M21.97 15.0602V18.8402C21.97 21.0002 20.97 22.0002 18.81 22.0002H12.5V10.4202L12.97 10.5202L17.47 11.5302L19.5 11.9802C20.82 12.2702 21.9 12.9502 21.96 14.8702C21.97 14.9302 21.97 14.9902 21.97 15.0602Z" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M5.5 9H8.97" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M5.5 13H8.97" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M17.47 11.53V14.75C17.47 15.99 16.46 17 15.22 17C13.98 17 12.97 15.99 12.97 14.75V10.52L17.47 11.53Z" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M21.96 14.87C21.9 16.05 20.92 17 19.72 17C18.48 17 17.47 15.99 17.47 14.75V11.53L19.5 11.98C20.82 12.27 21.9 12.95 21.96 14.87Z" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',
      ],
      [
        'slug' => 'work_phone_2',
        'data' => '+993 60 14 01 07',
        'type' => 'contact',
        'icon' => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12.5 22.0001H4.07997C2.91997 22.0001 1.96997 21.0701 1.96997 19.9301V5.09011C1.96997 2.47011 3.91997 1.2801 6.30997 2.4501L10.75 4.63011C11.71 5.10011 12.5 6.3501 12.5 7.4101V22.0001Z" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M21.97 15.0602V18.8402C21.97 21.0002 20.97 22.0002 18.81 22.0002H12.5V10.4202L12.97 10.5202L17.47 11.5302L19.5 11.9802C20.82 12.2702 21.9 12.9502 21.96 14.8702C21.97 14.9302 21.97 14.9902 21.97 15.0602Z" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M5.5 9H8.97" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M5.5 13H8.97" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M17.47 11.53V14.75C17.47 15.99 16.46 17 15.22 17C13.98 17 12.97 15.99 12.97 14.75V10.52L17.47 11.53Z" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M21.96 14.87C21.9 16.05 20.92 17 19.72 17C18.48 17 17.47 15.99 17.47 14.75V11.53L19.5 11.98C20.82 12.27 21.9 12.95 21.96 14.87Z" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',
      ],
      [
        'slug' => 'work_phone_3',
        'data' => '+993 60 14 01 09',
        'type' => 'contact',
        'icon' => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12.5 22.0001H4.07997C2.91997 22.0001 1.96997 21.0701 1.96997 19.9301V5.09011C1.96997 2.47011 3.91997 1.2801 6.30997 2.4501L10.75 4.63011C11.71 5.10011 12.5 6.3501 12.5 7.4101V22.0001Z" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M21.97 15.0602V18.8402C21.97 21.0002 20.97 22.0002 18.81 22.0002H12.5V10.4202L12.97 10.5202L17.47 11.5302L19.5 11.9802C20.82 12.2702 21.9 12.9502 21.96 14.8702C21.97 14.9302 21.97 14.9902 21.97 15.0602Z" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M5.5 9H8.97" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M5.5 13H8.97" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M17.47 11.53V14.75C17.47 15.99 16.46 17 15.22 17C13.98 17 12.97 15.99 12.97 14.75V10.52L17.47 11.53Z" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M21.96 14.87C21.9 16.05 20.92 17 19.72 17C18.48 17 17.47 15.99 17.47 14.75V11.53L19.5 11.98C20.82 12.27 21.9 12.95 21.96 14.87Z" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',
      ],
      [
        'slug' => 'fax',
        'data' => '+993 60 75 36 06',
        'type' => 'contact',
        'icon' => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M21.97 18.33C21.97 18.69 21.89 19.06 21.72 19.42C21.55 19.78 21.33 20.12 21.04 20.44C20.55 20.98 20.01 21.37 19.4 21.62C18.8 21.87 18.15 22 17.45 22C16.43 22 15.34 21.76 14.19 21.27C13.04 20.78 11.89 20.12 10.75 19.29C9.6 18.45 8.51 17.52 7.47 16.49C6.44 15.45 5.51 14.36 4.68 13.22C3.86 12.08 3.2 10.94 2.72 9.81C2.24 8.67 2 7.58 2 6.54C2 5.86 2.12 5.21 2.36 4.61C2.6 4 2.98 3.44 3.51 2.94C4.15 2.31 4.85 2 5.59 2C5.87 2 6.15 2.06 6.4 2.18C6.66 2.3 6.89 2.48 7.07 2.74L9.39 6.01C9.57 6.26 9.7 6.49 9.79 6.71C9.88 6.92 9.93 7.13 9.93 7.32C9.93 7.56 9.86 7.8 9.72 8.03C9.59 8.26 9.4 8.5 9.16 8.74L8.4 9.53C8.29 9.64 8.24 9.77 8.24 9.93C8.24 10.01 8.25 10.08 8.27 10.16C8.3 10.24 8.33 10.3 8.35 10.36C8.53 10.69 8.84 11.12 9.28 11.64C9.73 12.16 10.21 12.69 10.73 13.22C11.27 13.75 11.79 14.24 12.32 14.69C12.84 15.13 13.27 15.43 13.61 15.61C13.66 15.63 13.72 15.66 13.79 15.69C13.87 15.72 13.95 15.73 14.04 15.73C14.21 15.73 14.34 15.67 14.45 15.56L15.21 14.81C15.46 14.56 15.7 14.37 15.93 14.25C16.16 14.11 16.39 14.04 16.64 14.04C16.83 14.04 17.03 14.08 17.25 14.17C17.47 14.26 17.7 14.39 17.95 14.56L21.26 16.91C21.52 17.09 21.7 17.3 21.81 17.55C21.91 17.8 21.97 18.05 21.97 18.33Z" stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10"/></svg>',
      ],
      [
        'slug' => 'email',
        'data' => 'info@oguztravel.com',
        'type' => 'email',
        'icon' => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M17 20.5H7C4 20.5 2 19 2 15.5V8.5C2 5 4 3.5 7 3.5H17C20 3.5 22 5 22 8.5V15.5C22 19 20 20.5 17 20.5Z" stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/><path d="M17 9L13.87 11.5C12.84 12.32 11.15 12.32 10.12 11.5L7 9" stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/></svg>',
      ],
      [
        'slug' => 'instagram',
        'data' => 'https://instagram.com/oguztravel',
        'type' => 'social',
        'icon' => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9 22H15C20 22 22 20 22 15V9C22 4 20 2 15 2H9C4 2 2 4 2 9V15C2 20 4 22 9 22Z" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M12 15.5C13.933 15.5 15.5 13.933 15.5 12C15.5 10.067 13.933 8.5 12 8.5C10.067 8.5 8.5 10.067 8.5 12C8.5 13.933 10.067 15.5 12 15.5Z" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M17.6361 7H17.6477" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
      ],
      [
        'slug' => 'youtube',
        'data' => 'https://you.be/oguztravel',
        'type' => 'social',
        'icon' => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M17 20H7C4 20 2 18 2 15V9C2 6 4 4 7 4H17C20 4 22 6 22 9V15C22 18 20 20 17 20Z" stroke="#fff" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/><path d="M11.4001 9.50006L13.9001 11.0001C14.8001 11.6001 14.8001 12.5001 13.9001 13.1001L11.4001 14.6001C10.4001 15.2001 9.6001 14.7001 9.6001 13.6001V10.6001C9.6001 9.30006 10.4001 8.90006 11.4001 9.50006Z" stroke="#fff" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/></svg>',
      ],
    ];

    foreach ($arr as $item) {
      Contact::create($item);
    }
  }
}
