<?php

namespace Piboutique\SimpleCMS\Services\Menus;

use Illuminate\Support\Collection;

class DashboardMenuService extends MenuAbstract
{

    public function render(): Collection
    {
        return collect([
            'admin' => [
                [
                    'name' => 'dashboard',
                    'url' => route('dashboard'),
                    'icon' => 'fa fa-tachometer',
                    'active' => $this->isActive(request(), 'dashboard')
                ],

                [
                    'name' => 'pages',
                    'url' => route('pages.index'),
                    'icon' => 'fa fa-pagelines',
                    'active' => $this->isActive(request(), 'pages.index')
                ],

                [
                    'name' => 'portfolio',
                    'url' => route('items.index'),
                    'icon' => 'fa fa-bullhorn',
                    'active' => $this->isActive(request(), 'items.index')
                ],

                [
                    'name' => 'posts',
                    'url' => route('posts.index'),
                    'icon' => 'fa fa-bullhorn',
                    'active' => $this->isActive(request(), 'posts.index')
                ],

                [
                    'name' => 'images',
                    'url' => route('images.index'),
                    'icon' => 'fa fa-file-image-o',
                    'active' => $this->isActive(request(), 'images,index')
                ],

                [
                    'name' => 'theme options',
                    'url' => route('theme-options.index'),
                    'icon' => 'fa fa-file-image-o',
                    'active' => $this->isActive(request(), 'themes,index')
                ]
            ]
        ]);

    }
}