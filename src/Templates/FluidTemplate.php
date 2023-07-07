<?php

namespace Piboutique\SimpleCMS\Templates;

use Illuminate\View\View;
use Piboutique\SimpleCMS\Repositories\PageRepository;

/**
 * Class FluidTemplate
 * @package App\Templates
 */
class FluidTemplate extends AbstractTemplate
{
    /**
     * @var string
     */
    protected $template = 'fluid';
}
