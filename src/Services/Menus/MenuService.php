<?php

namespace Piboutique\SimpleCMS\Services\Menus;

use Illuminate\Support\Collection;
use Piboutique\SimpleCMS\Models\Page;

class MenuService extends MenuAbstract
{

    public function render(): Collection
    {
        $pages = Page::where('hidden', false)->get();
        $pages = $pages->map(function ($page) {
            return [
                'name' => $page['name'],
                'url' => $page['url']
            ];
        });
        return $pages;
    }
}