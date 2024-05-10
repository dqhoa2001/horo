<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('admins')->insert(
            [
                1 => ['name' => '管理者', 'email' => 'no-reply@hoshinomai.jp', 'password' => \Hash::make('L3iP2VCa'), 'remember_token' => \Str::random(10), 'email_verified_at' => now(), 'created_at' => now(), 'updated_at' => now()],
            ]
        );
    }
}
