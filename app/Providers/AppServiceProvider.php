<?php

namespace App\Providers;

use App\Models\Archive;
use App\Models\Folder;
use App\Policies\ArchivePolicy;
use App\Policies\FolderPolicy;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{


    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        Gate::policy(Folder::class, FolderPolicy::class);
        Gate::policy(Archive::class, ArchivePolicy::class);

    }
}
