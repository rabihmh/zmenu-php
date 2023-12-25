<?php

namespace App\Observers;

use App\Managers\TenantDataManger;
use App\Models\Category;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Facades\Cache;

class CategoryObserver
{
    /**
     * Handle the Category "created" event.
     */
    private string $restaurant_id;

    /**
     * @throws BindingResolutionException
     */
    public function __construct()
    {
        $this->restaurant_id = TenantDataManger::getTenantRestaurant()->id;
    }

    public function created(Category $category): void
    {
        $this->clearCache($category->id);
    }

    /**
     * Handle the Category "updated" event.
     */
    public function updated(Category $category): void
    {
        $this->clearCache($category->id);
    }

    /**
     * Handle the Category "deleted" event.
     */
    public function deleted(Category $category): void
    {
        $this->clearCache($category->id);
    }

    private function clearCache($category_id): void
    {
        Cache::forget('categories_' . $this->restaurant_id);
        Cache::forget("products_of_category_" . $category_id . "_restaurant_" . $this->restaurant_id);
    }

}
