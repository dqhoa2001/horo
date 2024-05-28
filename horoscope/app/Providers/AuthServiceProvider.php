<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Family;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        \App\Models\AppraisalApply::class => \App\Policies\AppraisalApplyPolicy::class,
        \App\Models\Family::class => \App\Policies\FamilyPolicy::class,
        \App\Models\SolarApply::class => \App\Policies\SolarAppraisalApplyPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
    }
}
