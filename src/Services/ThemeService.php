<?php

namespace Piboutique\SimpleCMS\Services;

use Illuminate\Support\Facades\File;
use Piboutique\SimpleCMS\Models\ThemeOptions;
use Illuminate\Contracts\Routing\UrlGenerator;

/**
 * Class ThemeService
 * @package Piboutique\SimpleCMS\Services
 */
class ThemeService
{
    /**
     * @param $path
     * @return UrlGenerator|string
     */
    public function findAsset($path)
    {
        $config = app('config')->get('cms.theme');
        $themeFolder = $config['folder'];

        if (!File::exists($themeFolder . 'manifest.json')) {
            return url($themeFolder . $path);
        }

        $manifest = File::get($themeFolder . 'manifest.json');
        $manifest = json_decode($manifest, true);
        return $manifest[$path] ?? null;
    }

    /**
     * @param $path
     * @return string
     */
    public function findAssetPath($path)
    {
        $config = app('config')->get('cms.theme');
        return public_path($config['folder'] . '/' . $config['active'] . '/assets/' . $path);
    }

    /**
     * @param $path
     * @return UrlGenerator|string
     */
    public function findBackendAsset($path)
    {
        $config = app('config')->get('cms.theme');
        $folder = $config['backend_folder'];
        if (!File::exists(public_path($folder . 'manifest.json'))) {
            return url($folder . $path);
        }

        $manifest = File::get(public_path($folder . 'manifest.json'));
        $manifest = json_decode($manifest, true);
        return $manifest[$path];
    }

    /**
     * @param $name
     * @return bool
     */
    public function getOption($name)
    {
        $option = ThemeOptions::where('name', $name)->first();
        if (is_null($option)) {
            return false;
        }

        return $option->value;
    }
}