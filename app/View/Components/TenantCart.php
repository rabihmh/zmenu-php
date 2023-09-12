<?php

namespace App\View\Components;

use App\Repositories\Cart\CartRepository;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TenantCart extends Component
{
    /**
     * Create a new component instance.
     */
    public CartRepository $cart;

    public function __construct(CartRepository $cartRepository)
    {
        $this->cart = $cartRepository;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tenant-cart');
    }
}
