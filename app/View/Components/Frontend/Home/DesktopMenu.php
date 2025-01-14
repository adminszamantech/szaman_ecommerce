<?php

namespace App\View\Components\Frontend\Home;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Category;

class DesktopMenu extends Component
{

    public $menu_categories;
    public function __construct()
    {
        $this->menu_categories = Category::with('sub_category')->orderBy('id', 'ASC')->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.frontend.home.desktop-menu');
    }
}
