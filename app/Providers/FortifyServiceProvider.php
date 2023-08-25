<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $currentDomain = \request()->getHost();
        if (Str::contains($currentDomain, 'admin.zmenu.test')) {
            Config::set('fortify.guard', 'admin');
            Config::set('fortify.passwords', 'users');
            Config::set('fortify.prefix', 'admin/dashboard');
            Config::set('fortify.domain', 'admin.zmenu.test');
            //Config::set('fortify.features.0','');//disable registration for admin
            Config::set('fortify.home', 'admin/dashboard');
            Fortify::viewPrefix('admin.auth.');
        } elseif (Str::contains($currentDomain, 'app.zmenu.test')) {
            Config::set('fortify.guard', 'web');
            Config::set('fortify.passwords', 'users');
            Config::set('fortify.prefix', '');
            Config::set('fortify.domain', 'app.zmenu.test');
            Config::set('fortify.home', '');
            Fortify::viewPrefix('tenantadmin.auth.');
        } else {
            Fortify::ignoreRoutes();
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())) . '|' . $request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
}
