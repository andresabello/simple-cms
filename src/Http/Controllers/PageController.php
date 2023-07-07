<?php

namespace Piboutique\SimpleCMS\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Piboutique\SimpleCMS\Models\Page;
use Illuminate\Contracts\View\Factory;
use Artesaos\SEOTools\Facades\SEOTools;
use Piboutique\SimpleCMS\Repositories\PageRepository;

/**
 * Class PageController
 * @package Piboutique\SimpleCMS\Http\Controllers\Backend
 */
class PageController
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
     * Display the specified rource.
     *
     * @param int $id
     * @param array $parameters
     * @return Factory|View
     * @throws \Exception
     */
    public function show($id, array $parameters)
    {
        $page = Page::find($id);
        $this->setSEO($page);
        $view = $this->prepareTemplate($page, $parameters);
        return view('page')->with(['page' => $page, 'view' => $view]);
    }

    /**
     * @param Page $page
     * @param array $parameters
     * @return View
     * @throws \Exception
     */
    private function prepareTemplate(Page $page, array $parameters)
    {
        $templates = config('cms.templates');
        if (!$page->template || !isset($templates[$page->template])) {
            throw new \Exception('no template found');
        }

        $template = app($templates[$page->template]);
        $view = sprintf('templates.%s', $template->getTemplate());
        if (!view()->exists($view)) {
            throw new \Exception('no template found');
        }

        return $template->setPage($page)->setView(view($view))->prepare($parameters);
    }

    /**
     * @param Page $page
     */
    private function setSEO(Page $page)
    {
        $featureImage = DB::table('images')
            ->leftJoin('imageables', 'imageables.image_id', '=', 'images.id')
            ->leftJoin('pages', 'pages.id', '=', 'imageables.imageable_id')
            ->where('imageables.featured', true)
            ->where('imageables.imageable_id', 39)
            ->where('imageables.imageable_type', 'Piboutique\SimpleCMS\Models\Column')
            ->first();

        SEOTools::setTitle($page->title);
//        SEOTools::setDescription($page->name);
        SEOTools::opengraph()->setUrl(url(config('app.url') . '/' . $page->url ?? '/'));
        SEOTools::setCanonical(url(config('app.url') . '/' . $page->url ?? '/'));
        SEOTools::opengraph()->addProperty('type', 'WebPage');
        SEOTools::twitter()->setSite(config('seotools.twitter.defaults.site'));
        if (!is_null($featureImage)) {
            SEOTools::opengraph()->addImage(url(config('app.url') . '/' . $featureImage->url));
            SEOTools::jsonLd()->addImage(url(config('app.url') . '/' . $featureImage->url));
        }
    }
}
