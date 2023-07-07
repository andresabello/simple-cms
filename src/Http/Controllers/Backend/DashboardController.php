<?php

namespace Piboutique\SimpleCMS\Http\Controllers\Backend;

class DashboardController
{
    /**
     * @return mixed
     */
    public function index()
    {
        return view('vendor.simple-cms.backend.dashboard');
    }

}