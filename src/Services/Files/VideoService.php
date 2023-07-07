<?php

namespace Piboutique\SimpleCMS\Services;

use Piboutique\SimpleCMS\Models\Video;
use Piboutique\SimpleCMS\Services\Files\FileAbstract;

/**
 * Class ImageService
 * @package Piboutique\SimpleCMS\Services
 */
class VideoService extends FileAbstract
{
    /**
     * @param $file
     * @return mixed
     */
    public function upload($file)
    {
        return Video::make($file)->save(storage_path('app/videos/' . $this->name));
    }
}