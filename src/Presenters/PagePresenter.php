<?php

namespace Piboutique\SimpleCMS\Presenters;

use Piboutique\SimpleCMS\Models\Page;

/**
 * Class PagePresenter
 * @package App\Presenters
 */
class PagePresenter
{
    /**
     * @param $pageId
     * @return string
     */
    public function contentHtml($pageId)
    {
        $page = Page::find($pageId);
        return strip_tags($page->content);
    }

    /**
     * @param $pageId
     * @return string
     */
    public function prettyUri($pageId)
    {
        $page = Page::find($pageId);
        return '/' . ltrim($page->url, '/');
    }

    /**
     * @param $pageId
     * @return string
     */
    public function linkToPaddedTitle($pageId)
    {
        $page = Page::find($pageId);
        $link = route('pages.edit', $pageId);
        $padding = str_repeat('&nbsp;', $page->depth * 4);
        return $padding . '<a href="' . $link . '">' . $page->title . '</a>';
    }

    /**
     * @return array
     */
    public function paddedTitle()
    {
        $pages = Page::all();
        $content = [];
        foreach ($pages as $index => $page) {
            $content[$index]['id'] = $page->id;
            $content[$index]['name'] = str_repeat('&nbsp;', $page->depth * 4) . $page->title;
        }
        return $content;
    }

    /**
     * @return string
     */
    public function uriWildcard()
    {
        return $this->url . '*';
    }
}
