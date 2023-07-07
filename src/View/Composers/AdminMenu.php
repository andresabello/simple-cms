<?php

namespace Piboutique\SimpleCMS\View\Composers;

use Illuminate\View\View;
use Piboutique\SimpleCMS\Services\Menus\DashboardMenuService;

/**
 * Class AdminMenu
 * @package Piboutique\SimpleCMS\View\Composers
 */
class AdminMenu
{
    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $view->with('menu', (new DashboardMenuService())->render());
    }
}
