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
        $this->clearCache($product->id,$product->category_id);
    }

    /**
     * Handle the Product "updated" event.
     */
    public function updated(Product $product): void
    {
        $this->clearCache($product->id,$product->category_id);
    }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {
        $this->clearCache($product->id,$product->category_id);


    }
    /**
     * @param $productId
     * @param $categoryId
     * @return void
     */
    private function clearCache($productId, $categoryId): void
    {
        Cache::forget('products_with_category_' . $this->restaurant_id);
        Cache::forget('product_' . $productId . '_restaurant_' . $this->restaurant_id);
        Cache::forget("products_of_category_" . $categoryId . "_restaurant_" . $this->restaurant_id);
    }
}
