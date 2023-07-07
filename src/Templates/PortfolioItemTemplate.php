<?php

namespace Piboutique\SimpleCMS\Templates;

use Illuminate\View\View;
use Piboutique\SimpleCMS\Models\Page;
use Piboutique\SimpleCMS\Models\Portfolio;
use Piboutique\SimpleCMS\Repositories\PageRepository;

/**
 * Class PortfolioItemTemplate
 * @package App\Templates
 */
class PortfolioItemTemplate extends AbstractTemplate
{
    /**
     * @var string
     */
    protected $template = 'portfolio.item';
}
