<?php
declare(strict_types=1);

namespace Piboutique\SimpleCMS\Templates;

use Illuminate\View\View;
use Piboutique\SimpleCMS\Models\Page;
use Piboutique\SimpleCMS\Repositories\PageRepository;

/**
 * Class RightSidebarTemplate
 * @package App\Templates
 */
class RightSidebarTemplate extends AbstractTemplate
{
    /**
     * @var string
     */
    protected $template = 'right-sidebar';
}
