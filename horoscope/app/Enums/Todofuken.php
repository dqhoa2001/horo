<?php

namespace App\Enums;

enum Todofuken: string
{
    case HOKKAIDO = 'Hokkaido';
    case AOMORI = 'Aomori';
    case IWATE = 'Iwate';
    case MIYAGI = 'Miyagi';
    case AKITA = 'Akita';
    case YAMAGATA = 'Yamagata';
    case FUKUSHIMA = 'Fukushima';
    case IBARAKI = 'Ibaraki';
    case TOCHIGI = 'Tochigi';
    case GUNMA = 'Gunma';
    case SAITAMA = 'Saitama';
    case CHIBA = 'Chiba';
    case TOKYO = 'Tokyo';
    case KANAGAWA = 'Kanagawa';
    case NIIGATA = 'Niigata';
    case TOYAMA = 'Toyama';
    case ISHIKAWA = 'Ishikawa';
    case FUKUI = 'Fukui';
    case YAMANASHI = 'Yamanashi';
    case NAGANO = 'Nagano';
    case GIFU = 'Gifu';
    case SHIZUOKA = 'Shizuoka';
    case AICHI = 'Aichi';
    case MIE = 'Mie';
    case SHIGA = 'Shiga';
    case KYOTO = 'Kyoto';
    case OSAKA = 'Osaka';
    case HYOGO = 'Hyogo';
    case NARA = 'Nara';
    case WAKAYAMA = 'Wakayama';
    case TOTTORI = 'Tottori';
    case SHIMANE = 'Shimane';
    case OKAYAMA = 'Okayama';
    case HIROSHIMA = 'Hiroshima';
    case YAMAGUCHI = 'Yamaguchi';
    case TOKUSHIMA = 'Tokushima';
    case KAGAWA = 'Kagawa';
    case EHIME = 'Ehime';
    case KOCHI = 'Kochi';
    case FUKUOKA = 'Fukuoka';
    case SAGA = 'Saga';
    case NAGASAKI = 'Nagasaki';
    case KUMAMOTO = 'Kumamoto';
    case OITA = 'Oita';
    case MIYAZAKI = 'Miyazaki';
    case KAGOSHIMA = 'Kagoshima';
    case OKINAWA = 'Okinawa';

    /** api用の数値を取得 */
    public static function toInt(): array
    {
        return [
            'Hokkaido' => 1,
            'Aomori' => 2,
            'Iwate' => 3,
            'Miyagi' => 4,
            'Akita' => 5,
            'Yamagata' => 6,
            'Fukushima' => 7,
            'Ibaraki' => 8,
            'Tochigi' => 9,
            'Gunma' => 10,
            'Saitama' => 11,
            'Chiba' => 12,
            'Tokyo' => 13,
            'Kanagawa' => 14,
            'Niigata' => 15,
            'Toyama' => 16,
            'Ishikawa' => 17,
            'Fukui' => 18,
            'Yamanashi' => 19,
            'Nagano' => 20,
            'Gifu' => 21,
            'Shizuoka' => 22,
            'Aichi' => 23,
            'Mie' => 24,
            'Shiga' => 25,
            'Kyoto' => 26,
            'Osaka' => 27,
            'Hyogo' => 28,
            'Nara' => 29,
            'Wakayama' => 30,
            'Tottori' => 31,
            'Shimane' => 32,
            'Okayama' => 33,
            'Hiroshima' => 34,
            'Yamaguchi' => 35,
            'Tokushima' => 36,
            'Kagawa' => 37,
            'Ehime' => 38,
            'Kochi' => 39,
            'Fukuoka' => 40,
            'Saga' => 41,
            'Nagasaki' => 42,
            'Kumamoto' => 43,
            'Oita' => 44,
            'Miyazaki' => 45,
            'Kagoshima' => 46,
            'Okinawa' => 47,
        ];
    }

    public static function getData(): array
    {
        return [
            ['name_en' => 'Hokkaido', 'name_jp' => '北海道', 'pref_num' => 1],
            ['name_en' => 'Aomori', 'name_jp' => '青森県', 'pref_num' => 2],
            ['name_en' => 'Iwate', 'name_jp' => '岩手県', 'pref_num' => 3],
            ['name_en' => 'Miyagi', 'name_jp' => '宮城県', 'pref_num' => 4],
            ['name_en' => 'Akita', 'name_jp' => '秋田県', 'pref_num' => 5],
            ['name_en' => 'Yamagata', 'name_jp' => '山形県', 'pref_num' => 6],
            ['name_en' => 'Fukushima', 'name_jp' => '福島県', 'pref_num' => 7],
            ['name_en' => 'Ibaraki', 'name_jp' => '茨城県', 'pref_num' => 8],
            ['name_en' => 'Tochigi', 'name_jp' => '栃木県', 'pref_num' => 9],
            ['name_en' => 'Gunma', 'name_jp' => '群馬県', 'pref_num' => 10],
            ['name_en' => 'Saitama', 'name_jp' => '埼玉県', 'pref_num' => 11],
            ['name_en' => 'Chiba', 'name_jp' => '千葉県', 'pref_num' => 12],
            ['name_en' => 'Tokyo', 'name_jp' => '東京都', 'pref_num' => 13],
            ['name_en' => 'Kanagawa', 'name_jp' => '神奈川県', 'pref_num' => 14],
            ['name_en' => 'Niigata', 'name_jp' => '新潟県', 'pref_num' => 15],
            ['name_en' => 'Toyama', 'name_jp' => '富山県', 'pref_num' => 16],
            ['name_en' => 'Ishikawa', 'name_jp' => '石川県', 'pref_num' => 17],
            ['name_en' => 'Fukui', 'name_jp' => '福井県', 'pref_num' => 18],
            ['name_en' => 'Yamanashi', 'name_jp' => '山梨県', 'pref_num' => 19],
            ['name_en' => 'Nagano', 'name_jp' => '長野県', 'pref_num' => 20],
            ['name_en' => 'Gifu', 'name_jp' => '岐阜県', 'pref_num' => 21],
            ['name_en' => 'Shizuoka', 'name_jp' => '静岡県', 'pref_num' => 22],
            ['name_en' => 'Aichi', 'name_jp' => '愛知県', 'pref_num' => 23],
            ['name_en' => 'Mie', 'name_jp' => '三重県', 'pref_num' => 24],
            ['name_en' => 'Shiga', 'name_jp' => '滋賀県', 'pref_num' => 25],
            ['name_en' => 'Kyoto', 'name_jp' => '京都府', 'pref_num' => 26],
            ['name_en' => 'Osaka', 'name_jp' => '大阪府', 'pref_num' => 27],
            ['name_en' => 'Hyogo', 'name_jp' => '兵庫県', 'pref_num' => 28],
            ['name_en' => 'Nara', 'name_jp' => '奈良県', 'pref_num' => 29],
            ['name_en' => 'Wakayama', 'name_jp' => '和歌山県', 'pref_num' => 30],
            ['name_en' => 'Tottori', 'name_jp' => '鳥取県', 'pref_num' => 31],
            ['name_en' => 'Shimane', 'name_jp' => '島根県', 'pref_num' => 32],
            ['name_en' => 'Okayama', 'name_jp' => '岡山県', 'pref_num' => 33],
            ['name_en' => 'Hiroshima', 'name_jp' => '広島県', 'pref_num' => 34],
            ['name_en' => 'Yamaguchi', 'name_jp' => '山口県', 'pref_num' => 35],
            ['name_en' => 'Tokushima', 'name_jp' => '徳島県', 'pref_num' => 36],
            ['name_en' => 'Kagawa', 'name_jp' => '香川県', 'pref_num' => 37],
            ['name_en' => 'Ehime', 'name_jp' => '愛媛県', 'pref_num' => 38],
            ['name_en' => 'Kochi', 'name_jp' => '高知県', 'pref_num' => 39],
            ['name_en' => 'Fukuoka', 'name_jp' => '福岡県', 'pref_num' => 40],
            ['name_en' => 'Saga', 'name_jp' => '佐賀県', 'pref_num' => 41],
            ['name_en' => 'Nagasaki', 'name_jp' => '長崎県', 'pref_num' => 42],
            ['name_en' => 'Kumamoto', 'name_jp' => '熊本県', 'pref_num' => 43],
            ['name_en' => 'Oita', 'name_jp' => '大分県', 'pref_num' => 44],
            ['name_en' => 'Miyazaki', 'name_jp' => '宮崎県', 'pref_num' => 45],
            ['name_en' => 'Kagoshima', 'name_jp' => '鹿児島県', 'pref_num' => 46],
            ['name_en' => 'Okinawa', 'name_jp' => '沖縄県', 'pref_num' => 47],
        ];
    }

    public static function toArray(): array
    {
        $enumsArr = Todofuken::cases();
        return array_column($enumsArr, 'value');
    }
}
