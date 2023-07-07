<?php

namespace Piboutique\SimpleCMS\Http\Controllers;

use Artesaos\SEOTools\Facades\OpenGraph;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\Factory;
use Piboutique\SimpleCMS\Models\Post;
use Artesaos\SEOTools\Facades\SEOTools;
use Piboutique\SimpleCMS\Repositories\PageRepository;

/**
 * Class PageController
 * @package Piboutique\SimpleCMS\Http\Controllers\Backend
 */
class PostController
{
    /**
     * @var PageRepository
     */
    protected $pageRepository;

    /**
     * PagesController constructor.
     * @param PageRepository $pageRepository
     */
    public function __construct(PageRepository $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @param $parameters
     * @return Factory|View
     * @throws \Exception
     */
    public function show($id, $parameters)
    {
        $post = Post::find($id);
        $this->setSEO($post);
        $view = $this->prepareTemplate(array_merge([
            'id' => $id,
        ], $parameters));
        return view('post')->with(['post' => $post, 'view' => $view]);
    }

    /**
     * @param array $parameters
     * @return View
     * @throws \Exception
     */
    private function prepareTemplate(array $parameters)
    {
        $templates = config('cms.templates');;
        $template = app($templates['post']);
        $view = sprintf('templates.%s', $template->getTemplate());
        if (!view()->exists($view)) {
            throw new \Exception('no template found');
        }

        return $template->setView(view($view))->prepare($parameters);
    }

    /**
     * @param Post $post
     */
    private function setSEO(Post $post)
    {
        $featureImage = DB::table('images')
            ->leftJoin('imageables', 'imageables.image_id', '=', 'images.id')
            ->leftJoin('posts', 'posts.id', '=', 'imageables.imageable_id')
            ->where('imageables.featured', true)
            ->where('imageables.imageable_id', $post->id)
            ->where('imageables.imageable_type', 'Piboutique\SimpleCMS\Models\Post')
            ->first();

        SEOTools::setTitle($post->title);
        SEOTools::setDescription($post->excerpt);
        SEOTools::opengraph()->setUrl(url(config('app.url') . '/blog/' . $post->slug));
        SEOTools::setCanonical(url(config('app.url') . '/blog/' . $post->slug));
        SEOTools::opengraph()->addProperty('type', 'articles');
        SEOTools::twitter()->setSite('@andresab3llo');
        if (!is_null($featureImage)) {
            SEOTools::opengraph()->addImage(url(config('app.url') . '/' . $featureImage->url));
            SEOTools::jsonLd()->addImage(url(config('app.url') . '/' . $featureImage->url));
        }
    }
}