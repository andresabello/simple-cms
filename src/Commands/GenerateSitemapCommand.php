<?php

namespace Piboutique\SimpleCMS\Commands;

use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use Illuminate\Support\Carbon;
use Illuminate\Console\Command;
use Piboutique\SimpleCMS\Models\Page;
use Piboutique\SimpleCMS\Models\Post;
use Illuminate\Support\Facades\Schema;

class GenerateSitemapCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the sitemap.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // modify this to your own needs
        $sitemapGenerator = Sitemap::create();

        if (Schema::hasTable('pages')) {
            $pages = Page::all();
            $pages->each(function (Page $page) use ($sitemapGenerator) {
                if ($page->hidden) {
                    return;
                }

                $sitemapGenerator->add(Url::create(url($page->url))
                    ->setLastModificationDate(Carbon::yesterday())
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
                    ->setPriority(0.1));
            });
        }

        if (Schema::hasTable('posts')) {
            $page = Page::where('template', 'posts')->first();
            $url = !is_null($page) ? $page->url . '/' : null;
            $posts = Post::all();
            $posts->each(function (Post $post) use ($sitemapGenerator, $url) {
                $sitemapGenerator->add(Url::create(url($url . $post->slug))
                    ->setLastModificationDate(Carbon::yesterday())
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
                    ->setPriority(0.1));
            });
        }

        $sitemapGenerator->writeToFile(public_path('sitemap.xml'));

    }
}