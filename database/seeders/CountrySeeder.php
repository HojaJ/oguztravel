<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CountrySeeder extends Seeder
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
        'name' => [
          'en' => 'Afghanistan',
          'ru' => 'Афганистан',
          'tm' => 'Owganystan',
          'zh' => '阿富汗',
        ],
      ],
      [
        'name' => [
          'en' => 'Albania',
          'ru' => 'Албания',
          'tm' => 'Albaniýa',
          'zh' => '阿尔巴尼亚',
        ],
      ],
      [
        'name' => [
          'en' => 'Algeria',
          'ru' => 'Алжир',
          'tm' => 'Jezaýir',
          'zh' => '阿尔及利亚',
        ],
      ],
      [
        'name' => [

          'en' => 'Andorra',
          'ru' => 'Андорра',
          'tm' => 'Andorra',
          'zh' => '安道尔',
        ],
      ],
      [
        'name' => [
          'en' => 'Angola',
          'ru' => 'Ангола',
          'tm' => 'Angola',
          'zh' => '安哥拉',
        ],
      ],
      [
        'name' => [
          'en' => 'Antigua and Barbuda',
          'ru' => 'Антигуа и Барбуда',
          'tm' => 'Antigua we Barbuda',
          'zh' => '安提瓜和巴布达',
        ],
      ],
      [
        'name' => [
          'en' => 'Argentina',
          'ru' => 'Аргентина',
          'tm' => 'Argentina',
          'zh' => '阿根廷',
        ],
      ],
      [
        'name' => [
          'en' => 'Armenia',
          'ru' => 'Армения',
          'tm' => 'Ermenistan',
          'zh' => '亚美尼亚',
        ],
      ],
      [
        'name' => [
          'en' => 'Australia',
          'ru' => 'Австралия',
          'tm' => 'Awstraliýa',
          'zh' => '澳大利亚',
        ],
      ],
      [
        'name' => [
          'en' => 'Austria',
          'ru' => 'Австрия',
          'tm' => 'Awstriýa',
          'zh' => '奥地利',
        ],
      ],
      [
        'name' => [
          'en' => 'Azerbaijan',
          'ru' => 'Азербайджан',
          'tm' => 'Azerbaýjan',
          'zh' => '阿塞拜疆',
        ],
      ],
      [
        'name' => [
          'en' => 'Bahamas',
          'ru' => 'Багамы',
          'tm' => 'Bagama',
          'zh' => '巴哈马',
        ],
      ],
      [
        'name' => [
          'en' => 'Bahrain',
          'ru' => 'Бахрейн',
          'tm' => 'Bahreýn',
          'zh' => '巴林',
        ],
      ],
      [
        'name' => [
          'en' => 'Bangladesh',
          'ru' => 'Бангладеш',
          'tm' => 'Bangladeş',
          'zh' => '孟加拉国',
        ],
      ],
      [
        'name' => [
          'en' => 'Barbados',
          'ru' => 'Барбадос',
          'tm' => 'Barbados',
          'zh' => '巴巴多斯',
        ],
      ],
      [
        'name' => [
          'en' => 'Belarus',
          'ru' => 'Беларусь',
          'tm' => 'Belarus',
          'zh' => '白俄罗斯',
        ],
      ],
      [
        'name' => [
          'en' => 'Belgium',
          'ru' => 'Бельгия',
          'tm' => 'Belgiýa',
          'zh' => '比利时',
        ],
      ],
      [
        'name' => [
          'en' => 'Belize',
          'ru' => 'Белиз',
          'tm' => 'Beliz',
          'zh' => '伯利兹',
        ],
      ],
      [
        'name' => [
          'en' => 'Benin',
          'ru' => 'Бенин',
          'tm' => 'Benin',
          'zh' => '贝宁',
        ],
      ],
      [
        'name' => [
          'en' => 'Bhutan',
          'ru' => 'Бутан',
          'tm' => 'Butan',
          'zh' => '不丹',
        ],
      ],
      [
        'name' => [
          'en' => 'Bolivia',
          'ru' => 'Боливия',
          'tm' => 'Boliwiýa',
          'zh' => '玻利维亚',
        ],
      ],
      [
        'name' => [
          'en' => 'Bosnia and Herzegovina',
          'ru' => 'Босния и Герцеговина',
          'tm' => 'Bosniýa we Gersegowina',
          'zh' => '波斯尼亚和黑塞哥维那',
        ],
      ],
      [
        'name' => [
          'en' => 'Botswana',
          'ru' => 'Ботсвана',
          'tm' => 'Botswana',
          'zh' => '博茨瓦纳',
        ],
      ],
      [
        'name' => [
          'en' => 'Brazil',
          'ru' => 'Бразилия',
          'tm' => 'Braziliýa',
          'zh' => '巴西',
        ],
      ],
      [
        'name' => [
          'en' => 'Brunei',
          'ru' => 'Бруней',
          'tm' => 'Bruneý',
          'zh' => '文莱',
        ],
      ],
      [
        'name' => [
          'en' => 'Bulgaria',
          'ru' => 'Болгария',
          'tm' => 'Bolgariýa',
          'zh' => '保加利亚',
        ],
      ],
      [
        'name' => [
          'en' => 'Burkina Faso',
          'ru' => 'Буркина-Фасо',
          'tm' => 'Burkina Faso',
          'zh' => '布基纳法索',
        ],
      ],
      [
        'name' => [
          'en' => 'Burundi',
          'ru' => 'Бурунди',
          'tm' => 'Burundi',
          'zh' => '布隆迪',
        ],
      ],
      [
        'name' => [
          'en' => "Côte d'Ivoire",
          'ru' => "Берег Слоновой Кости",
          'tm' => "Kot d'Iwuar",
          'zh' => "科特迪瓦",
        ],
      ],
      [
        'name' => [
          'en' => 'Cabo Verde',
          'ru' => 'Кабо-Верде',
          'tm' => 'Cabo Verde',
          'zh' => '佛得角',
        ],
      ],
      [
        'name' => [
          'en' => 'Cambodia',
          'ru' => 'Камбоджа',
          'tm' => 'Kamboja',
          'zh' => '柬埔寨',
        ],
      ],
      [
        'name' => [
          'en' => 'Cameroon',
          'ru' => 'Камерун',
          'tm' => 'Kamerun',
          'zh' => '喀麦隆',
        ],
      ],
      [
        'name' => [
          'en' => 'Canada',
          'ru' => 'Канада',
          'tm' => 'Kanada',
          'zh' => '加拿大',
        ],
      ],
      [
        'name' => [
          'en' => 'Central African Republic',
          'ru' => 'Центрально-Африканская Республика',
          'tm' => 'Merkezi Afrika Respublikasy',
          'zh' => '中非共和国',
        ],
      ],
      [
        'name' => [
          'en' => 'Chad',
          'ru' => 'Чад',
          'tm' => 'Çad',
          'zh' => '乍得',
        ],
      ],
      [
        'name' => [
          'en' => 'Chile',
          'ru' => 'Чили',
          'tm' => 'Çili',
          'zh' => '智利',
        ],
      ],
      [
        'name' => [
          'en' => 'China',
          'ru' => 'Китай',
          'tm' => 'Hytaý',
          'zh' => '中国',
        ],
      ],
      [
        'name' => [
          'en' => 'Colombia',
          'ru' => 'Колумбия',
          'tm' => 'Kolumbiýa',
          'zh' => '哥伦比亚',
        ],
      ],
      [
        'name' => [
          'en' => 'Comoros',
          'ru' => 'Коморы',
          'tm' => 'Komorlar',
          'zh' => '科摩罗',
        ],
      ],
      [
        'name' => [
          'en' => 'Congo-Brazzaville',
          'ru' => 'Конго-Браззавиль',
          'tm' => 'Kongo-Brazawil',
          'zh' => '刚果-布拉柴维尔',
        ],
      ],
      [
        'name' => [
          'en' => 'Costa Rica',
          'ru' => 'Коста-Рика',
          'tm' => 'Kosta Rika',
          'zh' => '哥斯达黎加',
        ],
      ],
      [
        'name' => [
          'en' => 'Croatia',
          'ru' => 'Хорватия',
          'tm' => 'Horwatiýa',
          'zh' => '克罗地亚',
        ],
      ],
      [
        'name' => [
          'en' => 'Cuba',
          'ru' => 'Куба',
          'tm' => 'Kuba',
          'zh' => '古巴',
        ],
      ],
      [
        'name' => [
          'en' => 'Cyprus',
          'ru' => 'Кипр',
          'tm' => 'Kipr',
          'zh' => '塞浦路斯',
        ],
      ],
      [
        'name' => [
          'en' => 'Czech Republic',
          'ru' => 'Чешская Республика',
          'tm' => 'Çehiýa',
          'zh' => '捷克共和国',
        ],
      ],
      [
        'name' => [
          'en' => 'Democratic Republic of the Congo',
          'ru' => 'Демократическая Республика Конго',
          'tm' => 'Kongo Demokratik Respublikasy',
          'zh' => '刚果民主共和国',
        ],
      ],
      [
        'name' => [
          'en' => 'Denmark',
          'ru' => 'Дания',
          'tm' => 'Daniýa',
          'zh' => '丹麦',
        ],
      ],
      [
        'name' => [
          'en' => 'Djibouti',
          'ru' => 'Джибути',
          'tm' => 'Jibuti',
          'zh' => '吉布提',
        ],
      ],
      [
        'name' => [
          'en' => 'Dominica',
          'ru' => 'Доминика',
          'tm' => 'Dominika',
          'zh' => '多米尼克',
        ],
      ],
      [
        'name' => [
          'en' => 'Dominican Republic',
          'ru' => 'Доминиканская Республика',
          'tm' => 'Dominikan Respublikasy',
          'zh' => '多明尼加共和国',
        ],
      ],
      [
        'name' => [
          'en' => 'Ecuador',
          'ru' => 'Эквадор',
          'tm' => 'Ekwador',
          'zh' => '厄瓜多尔',
        ],
      ],
      [
        'name' => [
          'en' => 'Egypt',
          'ru' => 'Египет',
          'tm' => 'Müsür',
          'zh' => '埃及',
        ],
      ],
      [
        'name' => [
          'en' => 'El Salvador',
          'ru' => 'Сальвадор',
          'tm' => 'El Salwador',
          'zh' => '萨尔瓦多',
        ],
      ],
      [
        'name' => [
          'en' => 'Equatorial Guinea',
          'ru' => 'Экваториальная Гвинея',
          'tm' => 'Ekwatorial Gwineýa',
          'zh' => '赤道几内亚',
        ],
      ],
      [
        'name' => [
          'en' => 'Eritrea',
          'ru' => 'Эритрея',
          'tm' => 'Eritreýa',
          'zh' => '厄立特里亚',
        ],
      ],
      [
        'name' => [
          'en' => 'Estonia',
          'ru' => 'Эстония',
          'tm' => 'Estoniýa',
          'zh' => '爱沙尼亚',
        ],
      ],
      [
        'name' => [
          'en' => 'Eswatini (Swaziland)',
          'ru' => 'Эсватини (Свазиленд)',
          'tm' => 'Eswatini (Swazilend)',
          'zh' => '埃斯瓦蒂尼语（斯威士兰)',
        ],
      ],
      [
        'name' => [
          'en' => 'Ethiopia',
          'ru' => 'Эфиопия',
          'tm' => 'Efiopiýa',
          'zh' => '埃塞俄比亚',
        ],
      ],
      [
        'name' => [
          'en' => 'Fiji',
          'ru' => 'Фиджи',
          'tm' => 'Fiji',
          'zh' => '斐济',
        ],
      ],
      [
        'name' => [
          'en' => 'Finland',
          'ru' => 'Финляндия',
          'tm' => 'Finlýandiýa',
          'zh' => '芬兰',
        ],
      ],
      [
        'name' => [
          'en' => 'France',
          'ru' => 'Франция',
          'tm' => 'Fransiýa',
          'zh' => '法国',
        ],
      ],
      [
        'name' => [
          'en' => 'Gabon',
          'ru' => 'Габон',
          'tm' => 'Gabon',
          'zh' => '加蓬',
        ],
      ],
      [
        'name' => [
          'en' => 'Gambia',
          'ru' => 'Гамбия',
          'tm' => 'Gambiýa',
          'zh' => '冈比亚',
        ],
      ],
      [
        'name' => [
          'en' => 'Georgia',
          'ru' => 'Грузия',
          'tm' => 'Jorjiýa',
          'zh' => '乔治亚州',
        ],
      ],
      [
        'name' => [
          'en' => 'Germany',
          'ru' => 'Германия',
          'tm' => 'Germaniýa',
          'zh' => '德国',
        ],
      ],
      [
        'name' => [
          'en' => 'Ghana',
          'ru' => 'Гана',
          'tm' => 'Gana',
          'zh' => '加纳',
        ],
      ],
      [
        'name' => [
          'en' => 'Greece',
          'ru' => 'Греция',
          'tm' => 'Gresiýa',
          'zh' => '希腊',
        ],
      ],
      [
        'name' => [
          'en' => 'Grenada',
          'ru' => 'Гренада',
          'tm' => 'Grenada',
          'zh' => '格林纳达',
        ],
      ],
      [
        'name' => [
          'en' => 'Guatemala',
          'ru' => 'Гватемала',
          'tm' => 'Gwatemala',
          'zh' => '危地马拉',
        ],
      ],
      [
        'name' => [
          'en' => 'Guinea',
          'ru' => 'Гвинея',
          'tm' => 'Gwineýa',
          'zh' => '几内亚',
        ],
      ],
      [
        'name' => [
          'en' => 'Guinea-Bissau',
          'ru' => 'Гвинея-Бисау',
          'tm' => 'Gwineýa-Bissau',
          'zh' => '几内亚比绍',
        ],
      ],
      [
        'name' => [
          'en' => 'Guyana',
          'ru' => 'Гайана',
          'tm' => 'Gaýana',
          'zh' => '圭亚那',
        ],
      ],
      [
        'name' => [
          'en' => 'Haiti',
          'ru' => 'Гаити',
          'tm' => 'Gaiti',
          'zh' => '海地',
        ],
      ],
      [
        'name' => [
          'en' => 'Holy See',
          'ru' => 'Святой Престол',
          'tm' => 'Mukaddes gör',
          'zh' => '教廷',
        ],
      ],
      [
        'name' => [
          'en' => 'Honduras',
          'ru' => 'Гондурас',
          'tm' => 'Gonduras',
          'zh' => '洪都拉斯',
        ],
      ],
      [
        'name' => [
          'en' => 'Hungary',
          'ru' => 'Венгрия',
          'tm' => 'Wengriýa',
          'zh' => '匈牙利',
        ],
      ],
      [
        'name' => [
          'en' => 'Iceland',
          'ru' => 'Исландия',
          'tm' => 'Islandiýa',
          'zh' => '冰岛',
        ],
      ],
      [
        'name' => [
          'en' => 'India',
          'ru' => 'Индия',
          'tm' => 'Hindistan',
          'zh' => '印度',
        ],
      ],
      [
        'name' => [
          'en' => 'Indonesia',
          'ru' => 'Индонезия',
          'tm' => 'Indoneziýa',
          'zh' => '印度尼西亚',
        ],
      ],
      [
        'name' => [
          'en' => 'Iran',
          'ru' => 'Иран',
          'tm' => 'Eýran',
          'zh' => '伊朗',
        ],
      ],
      [
        'name' => [
          'en' => 'Iraq',
          'ru' => 'Ирак',
          'tm' => 'Yrak',
          'zh' => '伊拉克',
        ],
      ],
      [
        'name' => [
          'en' => 'Ireland',
          'ru' => 'Ирландия',
          'tm' => 'Irlandiýa',
          'zh' => '爱尔兰',
        ],
      ],
      [
        'name' => [
          'en' => 'Israel',
          'ru' => 'Израиль',
          'tm' => 'Ysraýyl',
          'zh' => '以色列',
        ],
      ],
      [
        'name' => [
          'en' => 'Italy',
          'ru' => 'Италия',
          'tm' => 'Italiýa',
          'zh' => '意大利',
        ],
      ],
      [
        'name' => [
          'en' => 'Jamaica',
          'ru' => 'Ямайка',
          'tm' => 'Jamaamaýka',
          'zh' => '牙买加',
        ],
      ],
      [
        'name' => [
          'en' => 'Japan',
          'ru' => 'Япония',
          'tm' => 'Ýaponiýa',
          'zh' => '日本',
        ],
      ],
      [
        'name' => [
          'en' => 'Jordan',
          'ru' => 'Иордания',
          'tm' => 'Iordaniýa',
          'zh' => '约旦',
        ],
      ],
      [
        'name' => [
          'en' => 'Kazakhstan',
          'ru' => 'Казахстан',
          'tm' => 'Gazagystan',
          'zh' => '哈萨克斯坦',
        ],
      ],
      [
        'name' => [
          'en' => 'Kenya',
          'ru' => 'Кения',
          'tm' => 'Keniýa',
          'zh' => '肯尼亚',
        ],
      ],
      [
        'name' => [
          'en' => 'Kiribati',
          'ru' => 'Кирибати',
          'tm' => 'Kiribati',
          'zh' => '基里巴斯',
        ],
      ],
      [
        'name' => [
          'en' => 'Kuwait',
          'ru' => 'Кувейт',
          'tm' => 'Kuweýt',
          'zh' => '科威特',
        ],
      ],
      [
        'name' => [
          'en' => 'Kyrgyzstan',
          'ru' => 'Кыргызстан',
          'tm' => 'Gyrgyzystan',
          'zh' => '吉尔吉斯斯坦',
        ],
      ],
      [
        'name' => [
          'en' => 'Laos',
          'ru' => 'Лаос',
          'tm' => 'Laos',
          'zh' => '老挝',
        ],
      ],
      [
        'name' => [
          'en' => 'Latvia',
          'ru' => 'Латвия',
          'tm' => 'Latwiýa',
          'zh' => '拉脱维亚',
        ],
      ],
      [
        'name' => [
          'en' => 'Lebanon',
          'ru' => 'Ливан',
          'tm' => 'Liwan',
          'zh' => '黎巴嫩',
        ],
      ],
      [
        'name' => [
          'en' => 'Lesotho',
          'ru' => 'Лесото',
          'tm' => 'Lesoto',
          'zh' => '莱索托',
        ],
      ],
      [
        'name' => [
          'en' => 'Liberia',
          'ru' => 'Либерия',
          'tm' => 'Liberiýa',
          'zh' => '利比里亚',
        ],
      ],
      [
        'name' => [
          'en' => 'Libya',
          'ru' => 'Ливия',
          'tm' => 'Liwiýa',
          'zh' => '利比亚',
        ],
      ],
      [
        'name' => [
          'en' => 'Liechtenstein',
          'ru' => 'Лихтенштейн',
          'tm' => 'Lihtenşteýn',
          'zh' => '列支敦士登',
        ],
      ],
      [
        'name' => [
          'en' => 'Lithuania',
          'ru' => 'Литва',
          'tm' => 'Litwa',
          'zh' => '立陶宛',
        ],
      ],
      [
        'name' => [
          'en' => 'Luxembourg',
          'ru' => 'Люксембург',
          'tm' => 'Lýuksemburg',
          'zh' => '卢森堡',
        ],
      ],
      [
        'name' => [
          'en' => 'Madagascar',
          'ru' => 'Мадагаскар',
          'tm' => 'Madagaskar',
          'zh' => '马达加斯加',
        ],
      ],
      [
        'name' => [
          'en' => 'Malawi',
          'ru' => 'Малави',
          'tm' => 'Malawi',
          'zh' => '马拉维',
        ],
      ],
      [
        'name' => [
          'en' => 'Malaysia',
          'ru' => 'Малайзия',
          'tm' => 'Malaýziýa',
          'zh' => '马来西亚',
        ],
      ],
      [
        'name' => [
          'en' => 'Maldives',
          'ru' => 'Мальдивы',
          'tm' => 'Maldiw adalary',
          'zh' => '马尔代夫',
        ],
      ],
      [
        'name' => [
          'en' => 'Mali',
          'ru' => 'Мали',
          'tm' => 'Mali',
          'zh' => '马里',
        ],
      ],
      [
        'name' => [
          'en' => 'Malta',
          'ru' => 'Мальта',
          'tm' => 'Malta',
          'zh' => '马耳他',
        ],
      ],
      [
        'name' => [
          'en' => 'Marshall Islands',
          'ru' => 'Маршалловы острова',
          'tm' => 'Marşal adalary',
          'zh' => '马绍尔群岛',
        ],
      ],
      [
        'name' => [
          'en' => 'Mauritania',
          'ru' => 'Мавритания',
          'tm' => 'Mawritaniýa',
          'zh' => '毛里塔尼亚',
        ],
      ],
      [
        'name' => [
          'en' => 'Mauritius',
          'ru' => 'Маврикий',
          'tm' => 'Mawritis',
          'zh' => '毛里求斯',
        ],
      ],
      [
        'name' => [
          'en' => 'Mexico',
          'ru' => 'Мексика',
          'tm' => 'Meksika',
          'zh' => '墨西哥',
        ],
      ],
      [
        'name' => [
          'en' => 'Micronesia',
          'ru' => 'Микронезия',
          'tm' => 'Mikroneziýa',
          'zh' => '密克罗尼西亚',
        ],
      ],
      [
        'name' => [
          'en' => 'Moldova',
          'ru' => 'Молдова',
          'tm' => 'Moldowa',
          'zh' => '摩尔多瓦',
        ],
      ],
      [
        'name' => [
          'en' => 'Monaco',
          'ru' => 'Монако',
          'tm' => 'Monako',
          'zh' => '摩纳哥',
        ],
      ],
      [
        'name' => [
          'en' => 'Mongolia',
          'ru' => 'Монголия',
          'tm' => 'Mongoliýa',
          'zh' => '蒙古',
        ],
      ],
      [
        'name' => [
          'en' => 'Montenegro',
          'ru' => 'Черногория',
          'tm' => 'Çernogoriýa',
          'zh' => '黑山',
        ],
      ],
      [
        'name' => [
          'en' => 'Morocco',
          'ru' => 'Марокко',
          'tm' => 'Marokko',
          'zh' => '摩洛哥',
        ],
      ],
      [
        'name' => [
          'en' => 'Mozambique',
          'ru' => 'Мозамбик',
          'tm' => 'Mozambik',
          'zh' => '莫桑比克',
        ],
      ],
      [
        'name' => [
          'en' => 'Myanmar (Burma)',
          'ru' => 'Мьянма (Бирма)',
          'tm' => 'Mýanma (Birma)',
          'zh' => '缅甸（缅甸)',
        ],
      ],
      [
        'name' => [
          'en' => 'Namibia',
          'ru' => 'Намибия',
          'tm' => 'Namibiýa',
          'zh' => '纳米比亚',
        ],
      ],
      [
        'name' => [
          'en' => 'Nauru',
          'ru' => 'Науру',
          'tm' => 'Nauru',
          'zh' => '瑙鲁',
        ],
      ],
      [
        'name' => [
          'en' => 'Nepal',
          'ru' => 'Непал',
          'tm' => 'Nepal',
          'zh' => '尼泊尔',
        ],
      ],
      [
        'name' => [
          'en' => 'Netherlands',
          'ru' => 'Нидерланды',
          'tm' => 'Gollandiýa',
          'zh' => '荷兰',
        ],
      ],
      [
        'name' => [
          'en' => 'New Zealand',
          'ru' => 'Новая Зеландия',
          'tm' => 'Täze Zelandiýa',
          'zh' => '新西兰',
        ],
      ],
      [
        'name' => [
          'en' => 'Nicaragua',
          'ru' => 'Никарагуа',
          'tm' => 'Nikaragua',
          'zh' => '尼加拉瓜',
        ],
      ],
      [
        'name' => [
          'en' => 'Niger',
          'ru' => 'Нигер',
          'tm' => 'Niger',
          'zh' => '尼日尔',
        ],
      ],
      [
        'name' => [
          'en' => 'Nigeria',
          'ru' => 'Нигерия',
          'tm' => 'Nigeriýa',
          'zh' => '尼日利亚',
        ],
      ],
      [
        'name' => [
          'en' => 'North Korea',
          'ru' => 'Северная Корея',
          'tm' => 'Demirgazyk Koreýa',
          'zh' => '北朝鲜',
        ],
      ],
      [
        'name' => [
          'en' => 'North Macedonia',
          'ru' => 'Северная Македония',
          'tm' => 'Demirgazyk Makedoniýa',
          'zh' => '北马其顿',
        ],
      ],
      [
        'name' => [
          'en' => 'Norway',
          'ru' => 'Норвегия',
          'tm' => 'Norwegiýa',
          'zh' => '挪威',
        ],
      ],
      [
        'name' => [
          'en' => 'Oman',
          'ru' => 'Оман',
          'tm' => 'Umman',
          'zh' => '阿曼',
        ],
      ],
      [
        'name' => [
          'en' => 'Pakistan',
          'ru' => 'Пакистан',
          'tm' => 'Pakistan',
          'zh' => '巴基斯坦',
        ],
      ],
      [
        'name' => [
          'en' => 'Palau',
          'ru' => 'Палау',
          'tm' => 'Palau',
          'zh' => '帕劳',
        ],
      ],
      [
        'name' => [
          'en' => 'Palestine State',
          'ru' => 'Государство Палестина',
          'tm' => 'Palestina döwleti',
          'zh' => '巴勒斯坦国',
        ],
      ],
      [
        'name' => [
          'en' => 'Panama',
          'ru' => 'Панама',
          'tm' => 'Panama',
          'zh' => '巴拿马',
        ],
      ],
      [
        'name' => [
          'en' => 'Papua New Guinea',
          'ru' => 'Папуа - Новая Гвинея',
          'tm' => 'Papua Täze Gwineýa',
          'zh' => '巴布亚新几内亚',
        ],
      ],
      [
        'name' => [
          'en' => 'Paraguay',
          'ru' => 'Парагвай',
          'tm' => 'Paragwaý',
          'zh' => '巴拉圭',
        ],
      ],
      [
        'name' => [
          'en' => 'Peru',
          'ru' => 'Перу',
          'tm' => 'Peruda',
          'zh' => '秘鲁',
        ],
      ],
      [
        'name' => [
          'en' => 'Philippines',
          'ru' => 'Филиппины',
          'tm' => 'Filippinler',
          'zh' => '菲律宾',
        ],
      ],
      [
        'name' => [
          'en' => 'Poland',
          'ru' => 'Польша',
          'tm' => 'Polşa',
          'zh' => '波兰',
        ],
      ],
      [
        'name' => [
          'en' => 'Portugal',
          'ru' => 'Португалия',
          'tm' => 'Portugaliýa',
          'zh' => '葡萄牙',
        ],
      ],
      [
        'name' => [
          'en' => 'Qatar',
          'ru' => 'Катар',
          'tm' => 'Katar',
          'zh' => '卡塔尔',
        ],
      ],
      [
        'name' => [
          'en' => 'Romania',
          'ru' => 'Румыния',
          'tm' => 'Rumyniýa',
          'zh' => '罗马尼亚',
        ],
      ],
      [
        'name' => [
          'en' => 'Russia',
          'ru' => 'Россия',
          'tm' => 'Russiýa',
          'zh' => '俄罗斯',
        ],
      ],
      [
        'name' => [
          'en' => 'Rwanda',
          'ru' => 'Руанда',
          'tm' => 'Ruanda',
          'zh' => '卢旺达',
        ],
      ],
      [
        'name' => [
          'en' => 'Saint Kitts and Nevis',
          'ru' => 'Сент-Китс и Невис',
          'tm' => 'Keramatly Kitts we Newis',
          'zh' => '圣基茨和尼维斯',
        ],
      ],
      [
        'name' => [
          'en' => 'Saint Lucia',
          'ru' => 'Санкт-Люсия',
          'tm' => 'Keramatly Lýusiýa',
          'zh' => '圣卢西亚',
        ],
      ],
      [
        'name' => [
          'en' => 'Saint Vincent and the Grenadines',
          'ru' => 'Святой Винсент и Гренадины',
          'tm' => 'Keramatly Winsent we Grenadinler',
          'zh' => '圣文森特和格林纳丁斯',
        ],
      ],
      [
        'name' => [
          'en' => 'Samoa',
          'ru' => 'Самоа',
          'tm' => 'Samoa',
          'zh' => '萨摩亚',
        ],
      ],
      [
        'name' => [
          'en' => 'San Marino',
          'ru' => 'Сан-Марино',
          'tm' => 'San Marino',
          'zh' => '圣马力诺',
        ],
      ],
      [
        'name' => [
          'en' => 'Sao Tome and Principe',
          'ru' => 'Сан-Томе и Принсипи',
          'tm' => 'Sao Tome we Prinsip',
          'zh' => '圣多美和普林西比',
        ],
      ],
      [
        'name' => [
          'en' => 'Saudi Arabia',
          'ru' => 'Саудовская Аравия',
          'tm' => 'Saud Arabystany',
          'zh' => '沙特阿拉伯',
        ],
      ],
      [
        'name' => [
          'en' => 'Senegal',
          'ru' => 'Сенегал',
          'tm' => 'Senegal',
          'zh' => '塞内加尔',
        ],
      ],
      [
        'name' => [
          'en' => 'Serbia',
          'ru' => 'Сербия',
          'tm' => 'Serbiýa',
          'zh' => '塞尔维亚',
        ],
      ],
      [
        'name' => [
          'en' => 'Seychelles',
          'ru' => 'Сейшелы',
          'tm' => 'Seýşel adalary',
          'zh' => '塞舌尔',
        ],
      ],
      [
        'name' => [
          'en' => 'Sierra Leone',
          'ru' => 'Сьерра-Леоне',
          'tm' => 'Sierra Leone',
          'zh' => '塞拉利昂',
        ],
      ],
      [
        'name' => [
          'en' => 'Singapore',
          'ru' => 'Сингапур',
          'tm' => 'Singapur',
          'zh' => '新加坡',
        ],
      ],
      [
        'name' => [
          'en' => 'Slovakia',
          'ru' => 'Словакия',
          'tm' => 'Slowakiýa',
          'zh' => '斯洛伐克',
        ],
      ],
      [
        'name' => [
          'en' => 'Slovenia',
          'ru' => 'Словения',
          'tm' => 'Sloweniýa',
          'zh' => '斯洛文尼亚',
        ],
      ],
      [
        'name' => [
          'en' => 'Solomon Islands',
          'ru' => 'Соломоновы острова',
          'tm' => 'Süleýman adalary',
          'zh' => '所罗门群岛',
        ],
      ],
      [
        'name' => [
          'en' => 'Somalia',
          'ru' => 'Сомали',
          'tm' => 'Somali',
          'zh' => '索马里',
        ],
      ],
      [
        'name' => [
          'en' => 'South Africa',
          'ru' => 'Южная Африка',
          'tm' => 'Günorta Afrika',
          'zh' => '南非',
        ],
      ],
      [
        'name' => [
          'en' => 'South Korea',
          'ru' => 'Южная Корея',
          'tm' => 'Günorta Koreýa',
          'zh' => '韩国',
        ],
      ],
      [
        'name' => [
          'en' => 'South Sudan',
          'ru' => 'Южный Судан',
          'tm' => 'Günorta Sudan',
          'zh' => '南苏丹',
        ],
      ],
      [
        'name' => [
          'en' => 'Spain',
          'ru' => 'Испания',
          'tm' => 'Ispaniýa',
          'zh' => '西班牙',
        ],
      ],
      [
        'name' => [
          'en' => 'Sri Lanka',
          'ru' => 'Шри-Ланка',
          'tm' => 'Şri-Lanka',
          'zh' => '斯里兰卡',
        ],
      ],
      [
        'name' => [
          'en' => 'Sudan',
          'ru' => 'Судан',
          'tm' => 'Sudan',
          'zh' => '苏丹',
        ],
      ],
      [
        'name' => [
          'en' => 'Suriname',
          'ru' => 'Суринам',
          'tm' => 'Surinam',
          'zh' => '苏里南',
        ],
      ],
      [
        'name' => [
          'en' => 'Sweden',
          'ru' => 'Швеция',
          'tm' => 'Şwesiýa',
          'zh' => '瑞典',
        ],
      ],
      [
        'name' => [
          'en' => 'Switzerland',
          'ru' => 'Швейцария',
          'tm' => 'Şweýsariýa',
          'zh' => '瑞士',
        ],
      ],
      [
        'name' => [
          'en' => 'Syria',
          'ru' => 'Сирия',
          'tm' => 'Siriýa',
          'zh' => '叙利亚',
        ],
      ],
      [
        'name' => [
          'en' => 'Tajikistan',
          'ru' => 'Таджикистан',
          'tm' => 'Täjigistan',
          'zh' => '塔吉克斯坦',
        ],
      ],
      [
        'name' => [
          'en' => 'Tanzania',
          'ru' => 'Танзания',
          'tm' => 'Tanzaniýa',
          'zh' => '坦桑尼亚',
        ],
      ],
      [
        'name' => [
          'en' => 'Thailand',
          'ru' => 'Таиланд',
          'tm' => 'Taýland',
          'zh' => '泰国',
        ],
      ],
      [
        'name' => [
          'en' => 'Timor-Leste',
          'ru' => 'Тимор-Лешти',
          'tm' => 'Timor-Leste',
          'zh' => '东帝汶',
        ],
      ],
      [
        'name' => [
          'en' => 'Togo',
          'ru' => 'Того',
          'tm' => 'Togo',
          'zh' => '多哥',
        ],
      ],
      [
        'name' => [
          'en' => 'Tonga',
          'ru' => 'Тонга',
          'tm' => 'Tonga',
          'zh' => '汤加',
        ],
      ],
      [
        'name' => [
          'en' => 'Trinidad and Tobago',
          'ru' => 'Тринидад и Тобаго',
          'tm' => 'Trinidad we Tobago',
          'zh' => '特立尼达和多巴哥',
        ],
      ],
      [
        'name' => [
          'en' => 'Tunisia',
          'ru' => 'Тунис',
          'tm' => 'Tunis',
          'zh' => '突尼斯',
        ],
      ],
      [
        'name' => [
          'en' => 'Turkey',
          'ru' => 'Турция',
          'tm' => 'Türkiýe',
          'zh' => '火鸡',
        ],
      ],
      [
        'name' => [
          'en' => 'Turkmenistan',
          'ru' => 'Туркменистан',
          'tm' => 'Türkmenistan',
          'zh' => '土库曼斯坦',
        ],
      ],
      [
        'name' => [
          'en' => 'Tuvalu',
          'ru' => 'Тувалу',
          'tm' => 'Tuwalu',
          'zh' => '图瓦卢',
        ],
      ],
      [
        'name' => [
          'en' => 'Uganda',
          'ru' => 'Уганда',
          'tm' => 'Uganda',
          'zh' => '乌干达',
        ],
      ],
      [
        'name' => [
          'en' => 'Ukraine',
          'ru' => 'Украина',
          'tm' => 'Ukraina',
          'zh' => '乌克兰',
        ],
      ],
      [
        'name' => [
          'en' => 'United Arab Emirates',
          'ru' => 'Объединенные Арабские Эмираты',
          'tm' => 'Birleşen Arap Emirlikleri',
          'zh' => '阿拉伯联合酋长国',
        ],
      ],
      [
        'name' => [
          'en' => 'United Kingdom',
          'ru' => 'Великобритания',
          'tm' => 'Beýik Britaniýa',
          'zh' => '英国',
        ],
      ],
      [
        'name' => [
          'en' => 'United States of America',
          'ru' => 'Соединенные Штаты Америки',
          'tm' => 'Amerikanyň Birleşen Ştatlary',
          'zh' => '美国',
        ],
      ],
      [
        'name' => [
          'en' => 'Uruguay',
          'ru' => 'Уругвай',
          'tm' => 'Urugwaý',
          'zh' => '乌拉圭',
        ],
      ],
      [
        'name' => [
          'en' => 'Uzbekistan',
          'ru' => 'Узбекистан',
          'tm' => 'Özbegistan',
          'zh' => '乌兹别克斯坦',
        ],
      ],
      [
        'name' => [
          'en' => 'Vanuatu',
          'ru' => 'Вануату',
          'tm' => 'Wanuatu',
          'zh' => '瓦努阿图',
        ],
      ],
      [
        'name' => [
          'en' => 'Venezuela',
          'ru' => 'Венесуэла',
          'tm' => 'Wenesuela',
          'zh' => '委内瑞拉',
        ],
      ],
      [
        'name' => [
          'en' => 'Vietnam',
          'ru' => 'Вьетнам',
          'tm' => 'Wýetnam',
          'zh' => '越南',
        ],
      ],
      [
        'name' => [
          'en' => 'Yemen',
          'ru' => 'Йемен',
          'tm' => 'Yemen',
          'zh' => '也门',
        ],
      ],
      [
        'name' => [
          'en' => 'Zambia',
          'ru' => 'Замбия',
          'tm' => 'Zambiýa',
          'zh' => '赞比亚',
        ],
      ],
      [
        'name' => [
          'en' => 'Zimbabwe',
          'ru' => 'Зимбабве',
          'tm' => 'Zimbabwe',
          'zh' => '津巴布韦',
        ],
      ],
    ];

    foreach ($arr as $item) {
      Country::create($item);
    }
  }
}
