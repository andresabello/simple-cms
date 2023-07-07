<?php

namespace Piboutique\SimpleCMS\Presenters;


class ItemPresenter
{

    public function bodyHtml()
    {
        $converter = new CommonMarkConverter();
        return $converter->convertToHtml($this->description);
    }

    public function prettyUri()
    {
        return '/' . ltrim($this->url, '/');
    }

    public function linkToPaddedTitle($link)
    {
        return '<a href="'.$link.'">'.$this->title.'</a>';
    }

    public function paddedTitle()
    {
        $items = DB::table('item')->get();
        $content = [];
        foreach ($items as $item) {
            $content[$item->id] =  $item->title;
        }
        return $content;

        //return str_repeat('&nbsp;', $this->depth * 4) . $this->title;
    }

    public function uriWildcard()
    {
        return $this->url . '*';
    }
}
