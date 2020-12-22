<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define(\WebDevEtc\BlogEtc\Gates\GateTypes::MANAGE_BLOG_ADMIN, static function($user){
            // Implement your logic here, for example:
                return true;
            //    return $user->is_admin == true;
            // Or something like `$user->is_admin === true`
        });
    }
}
