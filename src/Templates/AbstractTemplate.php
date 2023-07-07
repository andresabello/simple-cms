<?php

namespace Piboutique\SimpleCMS\Templates;

use Illuminate\View\View;

/**
 * Class AbstractTemplate
 * @package App\Templates
 */
abstract class AbstractTemplate
{
    /**
     * @var
     */
    protected $template;

    /**
     * @var
     */
    protected $page;

    /**
     * @var View
     */
    protected $view;

    /**
     * @param array $parameters
     * @return mixed
     */
    public function prepare(array $parameters): View
    {
        return $this->view->with([
            'parameters', $parameters,
            'page' => $this->page
        ]);
    }

    /**
     * @return mixed
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @param mixed $view
     * @return AbstractTemplate
     */
    public function setView($view)
    {
        $this->view = $view;
        return $this;
    }

    /**
     * @param $page
     * @return AbstractTemplate
     */
    public function setPage($page)
    {
        $this->page = $page;
        return $this;
    }
}
