<?php

namespace Piboutique\SimpleCMS\Services\Menus;

use Illuminate\Http\Request;

/**
 * Class MenuAbstract
 * @package Piboutique\SimpleCMS\Services\Menus
 */
abstract class MenuAbstract implements MenuInterface
{
    /**
     * MenuAbstract constructor.
     */
    public function __construct()
    {
        if (app()->runningInConsole()) return;
    }

    /**
     * @param Request $request
     * @param $name
     * @return bool
     */
    protected function isActive(Request $request, $name)
    {
        $currentPage = $this->getCurrentPageName($request);

        if ($currentPage === 'dashboard') {
            return true;
        }

        if (strpos($currentPage, $name) !== false) {
            return true;
        }

        return false;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    protected function getCurrentPageName(Request $request)
    {
        $action = $request->route()->getAction();
        if (isset($action['as'])) {
            return $action['as'];
        }

        return $request->route()->getUri();
    }


}