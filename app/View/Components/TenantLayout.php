<?php

namespace App\View\Components;

use App\Models\Category;
use App\Models\Restaurant;
use Closure;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

class TenantLayout extends Component
{
    /**
     * Create a new component instance.
     */
    protected Collection $categories;
    protected Restaurant $restaurant;

    /**
     * @throws BindingResolutionException
     */
    public function __construct()
    {
        $this->restaurant = app()->make('restaurant.active');
        $this->categories = Cache::get('categories_' . $this->restaurant->id) ?? Category::query()->get();

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('layouts.tenant-layout', [
            'categories' => $this->categories,
            'restaurant' => $this->restaurant
        ]);
    }
}
