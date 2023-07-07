<?php

return [
    'phone' => env('APP_PHONE', '(800)777-7766'),

    'theme' => [
        'backend_folder' => 'vendor/dist',
        'folder' => 'vendor/dist',
        'active' => 'default'
    ],

    'templates' => [
        'home' => Piboutique\SimpleCMS\Templates\HomeTemplate::class,
        'contact' => Piboutique\SimpleCMS\Templates\ContactTemplate::class,
        'full-width' => Piboutique\SimpleCMS\Templates\FullWidthTemplate::class,
        'left-sidebar' => Piboutique\SimpleCMS\Templates\LeftSidebarTemplate::class,
        'right-sidebar' => Piboutique\SimpleCMS\Templates\RightSidebarTemplate::class,
        'fluid' => Piboutique\SimpleCMS\Templates\FluidTemplate::class,
        'posts' => Piboutique\SimpleCMS\Templates\BlogTemplate::class,
        'posts.post' => Piboutique\SimpleCMS\Templates\BlogPostTemplate::class,
        'portfolio' => Piboutique\SimpleCMS\Templates\PortfolioTemplate::class,
        'portfolio.item' => Piboutique\SimpleCMS\Templates\PortfolioItemTemplate::class,
    ]
];
