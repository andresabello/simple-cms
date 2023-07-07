<?php

namespace Piboutique\SimpleCMS;

use Piboutique\SimpleCMS\Models\Page;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Console\Scheduling\Schedule;
use Piboutique\SimpleCMS\Models\Post;
use Piboutique\SimpleCMS\View\ThemeViewFinder;
use Piboutique\SimpleCMS\View\Composers\MainMenu;
use Piboutique\SimpleCMS\View\Composers\AdminMenu;
use Piboutique\SimpleCMS\View\Composers\AddStatusMessage;

/**
 * Class SimpleCMSServiceProvider
 */
class SimpleCMSServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'Piboutique\SimpleCMS\Http\Controllers';

    protected $commands = [
        'Piboutique\SimpleCMS\Commands\GenerateSitemapCommand',
    ];

    /**
     */
    public function boot()
    {
        View::setFinder($this->app['theme.finder']);

        View::composer(['vendor.simple-cms.backend.layouts.backend', 'layouts.frontend'],
            AddStatusMessage::class);

        View::composer('vendor.simple-cms.backend.layouts.backend', AdminMenu::class);

        View::composer('layouts.frontend', MainMenu::class);

        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/resources/themes/default/views', 'simpleCMS');
        $this->loadMigrationsFrom(__DIR__ . '/Database/migrations');

        $this->publishes([
            __DIR__ . '/config/cms.php' => config_path('cms.php'),
        ], 'config');

        $this->publishes([
            __DIR__ . '/resources/themes/default/assets' => public_path('vendor/simple-cms/themes/default/assets'),
        ], 'frontend-assets');

        $this->publishes([
            __DIR__ . '/resources/themes/default/views' => public_path('vendor/simple-cms/themes/default/views'),
        ], 'frontend-views');

        $this->publishes([
            __DIR__ . '/resources/core/assets' => public_path('vendor/simple-cms/backend/assets'),
        ], 'backend-assets');

        $this->publishes([
            __DIR__ . '/resources/core/views' => resource_path('views/vendor/simple-cms/backend'),
        ], 'backend-views');

        $this->map();

        $this->app->booted(function () {
            $schedule = app(Schedule::class);
            $schedule->command('sitemap:generate')->daily();
        });
    }

    /**
     *
     */
    public function register()
    {
        $this->commands($this->commands);

        $this->app->singleton('theme.finder', function ($app) {
            $finder = new ThemeViewFinder($app['files'], $app['config']['view.paths']);
            $config = $app['config']['cms.theme'];
            $finder->setHints(View::getFinder()->getHints());
            $finder->setBasePath($app['path.public'] . '/' . 'vendor/simple-cms/themes');
            $finder->setActiveTheme($config['active']);
            return $finder;
        });
    }

    public function map()
    {
        $this->mapWebRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::group([
            'middleware' => 'web',
            'namespace' => $this->namespace,
        ], function ($router) {
            require __DIR__ . '/Http/routes.php';
        });

        if (Schema::hasTable('pages')) {
            $pages = Page::all();
            $route = request()->route();
            $params = isset($route) ? array_merge($route->parameters(), ['name' => $route->getName()]) : [];
            $pages->each(function (Page $page) use ($params) {
                $router = $this->app->make('router');
                $router->get($page->url, 'Piboutique\SimpleCMS\Http\Controllers\PageController@show')
                    ->defaults('id', $page->id)
                    ->defaults('parameters', $params)
                    ->name($page->name)
                    ->middleware('web');
            });
        }

        if (Schema::hasTable('posts')) {
            $page = Page::where('template', 'posts')->first();
            $url = !is_null($page) ? $page->url . '/' : null;
            $posts = Post::all();
            $posts->each(function (Post $post) use ($params, $url) {
                $router = $this->app->make('router');
                $router->get($url . $post->slug, 'Piboutique\SimpleCMS\Http\Controllers\PostController@show')
                    ->defaults('id', $post->id)
                    ->defaults('parameters', [
                        'slug' => $post->slug
                    ])
                    ->name($post->slug)
                    ->middleware('web');
            });
        }
    }

}
