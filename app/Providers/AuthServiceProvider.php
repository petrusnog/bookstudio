<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        $policies = [
            'listar-modulos' => ['admin'],
            'criar-usuarios' => ['admin']
        ];

        foreach ($policies as $action => $roles) {
            Gate::define($action, function ($user) use ($roles) {
                return in_array($user->role->name, $roles);
            });
        }
    }
}
