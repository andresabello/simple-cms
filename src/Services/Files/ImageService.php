<?php

namespace Piboutique\SimpleCMS\Services;

use Piboutique\SimpleCMS\Models\Image;
use Piboutique\SimpleCMS\Services\Files\FileAbstract;

/**
 * Class ImageService
 * @package Piboutique\SimpleCMS\Services
 */
class ImageService extends FileAbstract
{
    /**
     * @param $file
     * @return mixed
     */
    public function upload($file)
    {
        return Image::make($file)->save(storage_path('app/images/' . $this->name));
    }
}