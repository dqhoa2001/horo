<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\ToggleTestShipping;
use Illuminate\Database\Seeder;
use Database\Seeders\TemplateSeeder4;
use Database\Seeders\BookbindingUserApplySeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // if (!app()->environment('production')) {
        //     $this->call([
        //         AdminSeeder::class,
        //         UserSeeder::class,
        //         MemberSeeder::class,
        //         FamilySeeder::class,
        //         AppraisalApplySeeder::class,
        //         AppraisalClaimSeeder::class,
        //         BookbindingUserApplySeeder::class,
        //     ]);
        // }

        $this->call([
            AdminSeeder::class,
            UserSeeder::class,
            FamilySeeder::class,
            AppraisalApplySeeder::class,
            AppraisalClaimSeeder::class,
            BookbindingUserApplySeeder::class,
            HouseSeeder::class,
            PlanetSeeder::class,
            ZodiacSeeder::class,
            TimeZoneSeeder::class,
            AspectSeeder::class,
            AspectAngleSeeder::class,
            InquiryTypeSeeder::class,
            BookbindingSeeder::class,
            AppraisalSeeder::class,
            TemplateSeeder::class,
            BankInfoSeeder::class,
            RegisterCouponSeeder::class,
            AdminMailSeeder::class,
            AdminCouponSeeder::class,
            TemplateSeeder2::class,
            TemplateSeeder3::class,
            HousePatternSeeder::class,
            ZodiacPatternSeeder::class,
            SabianPatternSeeder::class,
            AspectPatternSeeder::class,
            TemplateSeeder4::class,
            TemplateSeeder5::class,
            TemplateSeeder6::class,
            TemplateSeeder7::class,
            TemplateSeeder8::class,
            TemplateSeeder9::class,
            ToggleTestShippingSeeder::class,
            // UpdateSolarPatternsSeeder::class,
            AppraisalSolarSeeder::class,
            BookbindingSolarSeeder::class,
            TemplateSeeder10::class,
        ]);

    }
}
