<?php

namespace Modules\Horoscope\Enums;

use BenSampo\Enum\Enum;

final class Time extends Enum
{
    const MinuteOfHour = 60;
    const Time = [
        [
            'label' => 'Select Time Zone',
            'value' => ''
        ],
        [
            'label' => 'GMT -12:00 hrs - IDLW',
            'value' => '-12'
        ],
        [
            'label' => 'GMT -11:00 hrs - BET or NT',
            'value' => '-11'
        ],
        [
            'label' => 'GMT -10:30 hrs - HST',
            'value' => '-10.5'
        ],
        [
            'label' => 'GMT -10:00 hrs - AHST',
            'value' => '-10'
        ],
        [
            'label' => 'GMT -09:30 hrs - HDT or HWT',
            'value' => '-9.5'
        ],
        [
            'label' => 'GMT -09:00 hrs - YST or AHDT or AHWT',
            'value' => '-9'
        ],
        [
            'label' => 'GMT -08:00 hrs - PST or YDT or YWT',
            'value' => '-8'
        ],
        [
            'label' => 'GMT -07:00 hrs - MST or PDT or PWT',
            'value' => '-7'
        ],
        [
            'label' => 'GMT -06:00 hrs - CST or MDT or MWT',
            'value' => '-6'
        ],
        [
            'label' => 'GMT -05:00 hrs - EST or CDT or CWT',
            'value' => '-5'
        ],
        [
            'label' => 'GMT -04:00 hrs - AST or EDT or EWT',
            'value' => '-4'
        ],
        [
            'label' => 'GMT -03:30 hrs - NST',
            'value' => '-3.5'
        ],
        [
            'label' => 'GMT -03:00 hrs - BZT2 or AWT',
            'value' => '-3'
        ],
        [
            'label' => 'GMT -02:00 hrs - AT',
            'value' => '-2'
        ],
        [
            'label' => 'GMT -01:00 hrs - WAT',
            'value' => '-1'
        ],
        [
            'label' => 'Greenwich Mean Time - GMT or UT',
            'value' => '0'
        ],
        [
            'label' => 'GMT +01:00 hrs - CET or MET or BST',
            'value' => '1'
        ],
        [
            'label' => 'GMT +02:00 hrs - EET or CED or MED or BDST or BWT',
            'value' => '2'
        ],
        [
            'label' => 'GMT +03:00 hrs - BAT or EED',
            'value' => '3'
        ],
        [
            'label' => 'GMT +03:30 hrs - IT',
            'value' => '3.5'
        ],
        [
            'label' => 'GMT +04:00 hrs - USZ3',
            'value' => '4'
        ],
        [
            'label' => 'GMT +05:00 hrs - USZ4',
            'value' => '5'
        ],
        [
            'label' => 'GMT +05:30 hrs - IST',
            'value' => '5.5'
        ],
        [
            'label' => 'GMT +06:00 hrs - USZ5',
            'value' => '6'
        ],
        [
            'label' => 'GMT +06:30 hrs - NST',
            'value' => '6.5'
        ],
        [
            'label' => 'GMT +07:00 hrs - SST or USZ6',
            'value' => '7'
        ],
        [
            'label' => 'GMT +07:30 hrs - JT',
            'value' => '7.5'
        ],
        [
            'label' => 'GMT +08:00 hrs - AWST or CCT',
            'value' => '8'
        ],
        [
            'label' => 'GMT +08:30 hrs - MT',
            'value' => '8.5'
        ],
        [
            'label' => 'GMT +09:00 hrs - JST or AWDT',
            'value' => '9',
            'selected' => true
        ],
        [
            'label' => 'GMT +09:30 hrs - ACST or SAT or SAST',
            'value' => '9.5'
        ],
        [
            'label' => 'GMT +10:00 hrs - AEST or GST',
            'value' => '10'
        ],
        [
            'label' => 'GMT +10:30 hrs - ACDT or SDT or SAD',
            'value' => '10.5'
        ],
        [
            'label' => 'GMT +11:00 hrs - UZ10 or AEDT',
            'value' => '11'
        ],
        [
            'label' => 'GMT +11:30 hrs - NZ',
            'value' => '11.5'
        ],
        [
            'label' => 'GMT +12:00 hrs - NZT or IDLE',
            'value' => '12'
        ],
        [
            'label' => 'GMT +12:30 hrs - NZS',
            'value' => '12.5'
        ],
        [
            'label' => 'GMT +13:00 hrs - NZST',
            'value' => '13'
        ],
    ];
}
