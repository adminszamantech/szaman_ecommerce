<?php

namespace App\View\Components\Frontend\Common;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Category;

class Header extends Component
{
    /**
     * Create a new component instance.
     */
    public $category_menus;
    public function __construct()
    {
        $this->category_menus = Category::with('sub_category')->orderBy('id', 'ASC')->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.frontend.common.header');
    }
}
