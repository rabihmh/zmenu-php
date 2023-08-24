<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SidebarTenantAdmin extends Component
{
    protected array $items;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->items = require(base_path('data/TenantAdminSidebarItems.php'));
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sidebar', [
            'items' => $this->items
        ]);
    }
}
