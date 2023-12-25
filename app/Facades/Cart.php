<?php

namespace App\Facades;

use App\Repositories\Cart\CartRepository;
use Illuminate\Support\Facades\Facade;

/**
 * @method static total()
 * @method static get()
 * @method static empty()
 */
class Cart extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return CartRepository::class;
    }
}
