<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TimeZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('h_time_zone')->insert([
            'name' => 'GMT -12:00 hrs - IDLW',
            'timezone' => '-12',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_time_zone')->insert([
            'name' => 'GMT -11:00 hrs - BET or NT',
            'timezone' => '-11',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_time_zone')->insert([
            'name' => 'GMT -10:30 hrs - HST',
            'timezone' => '-10.5',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_time_zone')->insert([
            'name' => 'GMT -10:00 hrs - AHST',
            'timezone' => '-10',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_time_zone')->insert([
            'name' => 'GMT -09:30 hrs - HDT or HWT',
            'timezone' => '-9.5',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_time_zone')->insert([
            'name' => 'GMT -09:00 hrs - YST or AHDT or AHWT',
            'timezone' => '-9',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_time_zone')->insert([
            'name' => 'GMT -08:00 hrs - PST or YDT or YWT',
            'timezone' => '-8',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_time_zone')->insert([
            'name' => 'GMT -07:00 hrs - MST or PDT or PWT',
            'timezone' => '-7',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_time_zone')->insert([
            'name' => 'GMT -06:00 hrs - CST or MDT or MWT',
            'timezone' => '-6',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_time_zone')->insert([
            'name' => 'GMT -05:00 hrs - EST or CDT or CWT',
            'timezone' => '-5',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_time_zone')->insert([
            'name' => 'GMT -04:00 hrs - AST or EDT or EWT',
            'timezone' => '-4',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_time_zone')->insert([
            'name' => 'GMT -03:30 hrs - NST',
            'timezone' => '-3.5',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_time_zone')->insert([
            'name' => 'GMT -03:00 hrs - BZT2 or AWT',
            'timezone' => '-3',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_time_zone')->insert([
            'name' => 'GMT -02:00 hrs - AT',
            'timezone' => '-2',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_time_zone')->insert([
            'name' => 'GMT -01:00 hrs - WAT',
            'timezone' => '-1',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_time_zone')->insert([
            'name' => 'Greenwich Mean Time - GMT or UT',
            'timezone' => '0',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_time_zone')->insert([
            'name' => 'GMT +01:00 hrs - CET or MET or BST',
            'timezone' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_time_zone')->insert([
            'name' => 'GMT +02:00 hrs - EET or CED or MED or BDST or BWT',
            'timezone' => '2',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_time_zone')->insert([
            'name' => 'GMT +03:00 hrs - BAT or EED',
            'timezone' => '3',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_time_zone')->insert([
            'name' => 'GMT +03:30 hrs - IT',
            'timezone' => '3.5',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_time_zone')->insert([
            'name' => 'GMT +04:00 hrs - USZ3',
            'timezone' => '4',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_time_zone')->insert([
            'name' => 'GMT +05:00 hrs - USZ4',
            'timezone' => '5',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_time_zone')->insert([
            'name' => 'GMT +05:30 hrs - IST',
            'timezone' => '5.5',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_time_zone')->insert([
            'name' => 'GMT +06:00 hrs - USZ5',
            'timezone' => '6',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_time_zone')->insert([
            'name' => 'GMT +06:30 hrs - NST',
            'timezone' => '6.5',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_time_zone')->insert([
            'name' => 'GMT +07:00 hrs - SST or USZ6',
            'timezone' => '7',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_time_zone')->insert([
            'name' => 'GMT +07:30 hrs - JT',
            'timezone' => '7.5',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_time_zone')->insert([
            'name' => 'GMT +08:00 hrs - AWST or CCT',
            'timezone' => '8',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_time_zone')->insert([
            'name' => 'GMT +08:30 hrs - MT',
            'timezone' => '8.5',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_time_zone')->insert([
            'name' => 'GMT +09:00 hrs - JST or AWDT',
            'timezone' => '9',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_time_zone')->insert([
            'name' => 'GMT +09:30 hrs - ACST or SAT or SAST',
            'timezone' => '9.5',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_time_zone')->insert([
            'name' => 'GMT +10:00 hrs - AEST or GST',
            'timezone' => '10',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_time_zone')->insert([
            'name' => 'GMT +10:30 hrs - ACDT or SDT or SAD',
            'timezone' => '10.5',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_time_zone')->insert([
            'name' => 'GMT +11:00 hrs - UZ10 or AEDT',
            'timezone' => '11',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_time_zone')->insert([
            'name' => 'GMT +11:30 hrs - NZ',
            'timezone' => '11.5',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_time_zone')->insert([
            'name' => 'GMT +12:00 hrs - NZT or IDLE',
            'timezone' => '12',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_time_zone')->insert([
            'name' => 'GMT +12:30 hrs - NZS',
            'timezone' => '12.5',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_time_zone')->insert([
            'name' => 'GMT +13:00 hrs - NZST',
            'timezone' => '13',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
