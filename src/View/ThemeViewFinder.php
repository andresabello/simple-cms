<?php

namespace Piboutique\SimpleCMS\View;

use Illuminate\View\FileViewFinder;

/**
 * Class ThemeViewFinder
 * @package App\View
 */
class ThemeViewFinder extends FileViewFinder
{
    /**
     * @var
     */
    protected $activeTheme;

    /**
     * @var
     */
    protected $basePath;

    /**
     * @param $path
     */
    public function setBasePath($path)
    {
        $this->basePath = $path;
    }

    /**
     * @param $theme
     */
    public function setActiveTheme($theme)
    {
        $this->activeTheme = $theme;
        array_unshift($this->paths, $this->basePath . '/' . $theme . '/views');
    }

    /**
     * @param $hints
     */
    public function setHints($hints)
    {
        $this->hints = $hints;
    }
}
