<?php

namespace Piboutique\SimpleCMS\Services\Menus;

use Illuminate\Support\Collection;

interface MenuInterface
{
    public function render(): Collection;
}