<?php

namespace Piboutique\SimpleCMS\View\Composers;

use Illuminate\View\View;
use Piboutique\SimpleCMS\Services\Menus\MenuService;

/**
 * Class AdminMenu
 * @package Piboutique\SimpleCMS\View\Composers
 */
class MainMenu
{
    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $view->with('menu', (new MenuService())->render());
    }
}
