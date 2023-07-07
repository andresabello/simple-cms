<?php

namespace Piboutique\SimpleCMS\View\Composers;

use Illuminate\View\View;

/**
 * Class AddStatusMessage
 * @package App\View\Composers
 */
class AddStatusMessage
{
    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $view->with('status', session('status'));
    }
}
