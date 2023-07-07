<?php

namespace Piboutique\SimpleCMS\Presenters;

class PostPresenter
{

    public function excerptHtml()
    {
        $converter = new CommonMarkConverter();
        return $converter->convertToHtml($this->excerpt);
    }

    public function bodyHtml()
    {
        $converter = new CommonMarkConverter();
        return $converter->convertToHtml($this->body);
    }

    public function publishedDate()
    {
        if ($this->published_at) {
            return $this->published_at->toFormattedDateString();
        }

        return 'Not Published';
    }

    public function publishedHighlight()
    {
        if ($this->published_at && $this->published_at->isFuture()) {
            return 'info';
        }

        return 'warning';
    }
}
