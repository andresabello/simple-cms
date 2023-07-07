<?php


namespace Piboutique\SimpleCMS\Services\Files;


/**
 * Interface FileInterface
 * @package Piboutique\SimpleCMS\Services\Files
 */
interface FileInterface
{
    /**
     * @param string $name
     * @return mixed
     */
    public function setName(string $name);

    /**
     * @param $file
     * @return mixed
     */
    public function upload($file);
}