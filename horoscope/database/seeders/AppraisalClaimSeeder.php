<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppraisalClaimSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('appraisal_claims')->insert([
            [
                'appraisal_apply_id' => 1,
                'user_id'            => 1,
                'payment_intent_id'  => 'pi_3O9T4oAsc1m9Dhdw0ygsgWpq',
                'price'              => 8800,
                'purchase_date'      => '2023-12-01',
                'payment_type'        => \App\Models\AppraisalClaim::CREDIT,
                'content_type'       => \App\Models\AppraisalClaim::PERSONAL,
                'is_paid'            => true,
                'paid_at'            => '2023-12-01',
            ],
            [
                'appraisal_apply_id' => 2,
                'user_id'            => 2,
                'payment_intent_id'  => null,
                'price'              => 8800,
                'purchase_date'      => '2023-11-23',
                'payment_type'        => \App\Models\AppraisalClaim::BANK,
                'content_type'       => \App\Models\AppraisalClaim::PERSONAL,
                'is_paid'            => true,
                'paid_at'            => '2023-12-01',
            ],
            [
                'appraisal_apply_id' => 3,
                'usre_id'            => 1,
                'payment_intent_id'  => null,
                'price'              => 8800,
                'purchase_date'      => '2023-11-23',
                'payment_type'        => \App\Models\AppraisalClaim::CREDIT,
                'content_type'       => \App\Models\AppraisalClaim::PERSONAL_BOOKING,
                'is_paid'            => true,
                'paid_at'            => '2023-11-23',
            ],
            [
                'appraisal_apply_id' => 4,
                'user_id'            => 1,
                'payment_intent_id'  => null,
                'price'              => 8800,
                'purchase_date'      => '2023-11-24',
                'payment_type'       => \App\Models\AppraisalClaim::BANK,
                'content_type'       => \App\Models\AppraisalClaim::PERSONAL_BOOKING,
                'is_paid'            => true,
                'paid_at'            => null,
            ],
        ]);

    }
}
