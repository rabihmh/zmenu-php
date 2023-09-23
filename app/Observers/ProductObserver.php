<?php

namespace App\Observers;

use App\Managers\TenantDataManger;
use App\Models\Product;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Facades\Cache;

class ProductObserver
{
    protected string $restaurant_id;

    /**
     * @throws BindingResolutionException
     */
    public function __construct()
    {
        $this->restaurant_id = TenantDataManger::getTenantRestaurant()->id;
    }

    /**
     * Handle the Product "created" event.
     */
    public function created(Product $product): void
    {
        Cache::forget('products_with_category_' . $this->restaurant_id);
//        $restaurant_id = $this->restaurant_id;
//        $cacheKey = 'products_with_category_' . $restaurant_id;
//
//         Remove the specific product from the cache
//        Cache::tags([$cacheKey])->forget($product->id);
    }

    /**
     * Handle the Product "updated" event.
     */
    public function updated(Product $product): void
    {
        Cache::forget('products_with_category_' . $this->restaurant_id);

    }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {
        Cache::forget('products_with_category_' . $this->restaurant_id);

    }

    /**
     * Handle the Product "restored" event.
     */
    public function restored(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     */
    public function forceDeleted(Product $product): void
    {
        //
    }
}
