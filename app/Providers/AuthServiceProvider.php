<?php

namespace App\Providers;

use App\Models\Item;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

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
        Gate::define('edit-item', function (User $user, Item $item) {
            return $user->id === $item->user_id;
        });
        Gate::define('remove-item', function (User $user, Item $item) {
            return $user->id === $item->user_id;
        });
    }
}
