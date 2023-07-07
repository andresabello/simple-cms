<?php

namespace Piboutique\SimpleCMS\Repositories\Interfaces;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Interface GetModel
 * @package App\Repositories\Interfaces
 */
interface UpdateModelInterface
{
    /**
     * @param int $modelId
     * @return mixed
     */
    public function setModel(int $modelId);

    /**
     * @param FormRequest $request
     * @return mixed
     */
    public function handle(FormRequest $request): bool;
}