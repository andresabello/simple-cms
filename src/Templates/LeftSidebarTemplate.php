<?php
declare(strict_types=1);

namespace Piboutique\SimpleCMS\Templates;

use Illuminate\View\View;
use Piboutique\SimpleCMS\Models\Page;
use Piboutique\SimpleCMS\Repositories\PageRepository;

/**
 * Class LeftSidebarTemplate
 * @package App\Templates
 */
class LeftSidebarTemplate extends AbstractTemplate
{

    /**
     * @var string
     */
    protected $template = 'left-sidebar';
}
