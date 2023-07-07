<?php

namespace Piboutique\SimpleCMS\Services\Files;

use Carbon\Carbon;

abstract class FileAbstract implements FileInterface
{
    /**
     * @var null
     */
    protected $name = null;

    /**
     * @return string
     * @throws \Exception
     */
    public function getFormattedTimestamp()
    {
        $carbon = new Carbon();
        $now = $carbon->now();

        return str_replace([' ', ':'], '-', $now->year . '-' . $now->month);
    }

    /**
     * @param $timestamp
     * @param $file
     * @return string
     */
    public function getSavedFileName($timestamp, $file)
    {
        return $timestamp . '-' . $file->getClientOriginalName();
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }
}