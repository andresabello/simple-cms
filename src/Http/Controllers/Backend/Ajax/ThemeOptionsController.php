<?php

namespace Piboutique\SimpleCMS\Http\Controllers\Backend\Ajax;

use Illuminate\Http\JsonResponse;
use Piboutique\SimpleCMS\Models\ThemeOptions;

/**
 * Class PageController
 * @package Piboutique\SimpleCMS\Http\Controllers\Backend
 */
class ThemeOptionsController
{

    /**
     * Display a listing of the resource
     *
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json([
            'options' => ThemeOptions::all()
        ]);
    }
}