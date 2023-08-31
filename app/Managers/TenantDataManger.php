<?php

namespace App\Managers;

use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Contracts\Container\BindingResolutionException;

class TenantDataManger
{

    /**
     * @throws BindingResolutionException
     */
    public static function getTenantAdmin()
    {
        return app()->make(User::class);
    }

    /**
     * @throws BindingResolutionException
     */
    public static function getTenantRestaurant()
    {
        return app()->make(Restaurant::class);
    }
}
