<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('h_members')->insert([
            'name' => '',
            'email' => 'admin' . '@gmail.com',
            'phone' => '9876543210',
            'day_of_birth' => now(),
            'verify_at' => now(),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_members')->insert([
            'name' => '',
            'email' => 'user' . '@gmail.com',
            'phone' => '9876543210',
            'day_of_birth' => now(),
            'verify_at' => now(),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_members')->insert([
            'name' => '',
            'email' => 'user1' . '@gmail.com',
            'phone' => '9876543210',
            'day_of_birth' => now(),
            'verify_at' => now(),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_members')->insert([
            'name' => '',
            'email' => 'user2' . '@gmail.com',
            'phone' => '9876543210',
            'day_of_birth' => now(),
            'verify_at' => now(),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_members')->insert([
            'name' => '',
            'email' => 'user3' . '@gmail.com',
            'phone' => '9876543210',
            'day_of_birth' => now(),
            'verify_at' => now(),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_members')->insert([
            'name' => '',
            'email' => 'user4' . '@gmail.com',
            'phone' => '9876543210',
            'day_of_birth' => now(),
            'verify_at' => now(),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_members')->insert([
            'name' => '',
            'email' => 'user5' . '@gmail.com',
            'phone' => '9876543210',
            'day_of_birth' => now(),
            'verify_at' => now(),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_members')->insert([
            'name' => '',
            'email' => 'user6' . '@gmail.com',
            'phone' => '9876543210',
            'day_of_birth' => now(),
            'verify_at' => now(),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_members')->insert([
            'name' => '',
            'email' => 'user7' . '@gmail.com',
            'phone' => '9876543210',
            'day_of_birth' => now(),
            'verify_at' => now(),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_members')->insert([
            'name' => '',
            'email' => 'user8' . '@gmail.com',
            'phone' => '9876543210',
            'day_of_birth' => now(),
            'verify_at' => now(),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_members')->insert([
            'name' => '',
            'email' => 'user9' . '@gmail.com',
            'phone' => '9876543210',
            'day_of_birth' => now(),
            'verify_at' => now(),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_members')->insert([
            'name' => '',
            'email' => 'user10' . '@gmail.com',
            'phone' => '9876543210',
            'day_of_birth' => now(),
            'verify_at' => now(),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_members')->insert([
            'name' => '',
            'email' => 'user11' . '@gmail.com',
            'phone' => '9876543210',
            'day_of_birth' => now(),
            'verify_at' => now(),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_members')->insert([
            'name' => '',
            'email' => 'user12' . '@gmail.com',
            'phone' => '9876543210',
            'day_of_birth' => now(),
            'verify_at' => now(),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('h_members')->insert([
            'name' => '',
            'email' => 'user13' . '@gmail.com',
            'phone' => '9876543210',
            'day_of_birth' => now(),
            'verify_at' => now(),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
