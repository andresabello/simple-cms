<?php

namespace Piboutique\SimpleCMS\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Interface CreateModelInterface
 * @package App\Repositories\Interfaces
 */
interface CreateModelInterface
{
    /**
     * @param FormRequest $request
     * @return mixed
     */
    public function handle(FormRequest $request): Model;
}