<?php

namespace Piboutique\SimpleCMS\Repositories\Interfaces;

use Illuminate\Support\Collection;

/**
 * Interface GetModel
 * @package App\Repositories\Interfaces
 */
interface GetModelInterface
{
    /**
     * @param int $offset
     * @return GetModelInterface
     */
    public function setOffset(int $offset): GetModelInterface;

    /**
     * @param $field
     * @return GetModelInterface
     */
    public function setField($field): GetModelInterface;

    /**
     * @param int $id
     * @return mixed
     */
    public function getById(int $id): \stdClass;

    /**
     * @param int $offset
     * @return mixed
     */
    public function getAll(int $offset = 0): Collection;

    /**
     * @param $value
     * @return \stdClass
     */
    public function getByField($value): \stdClass;

    /**
     * @param $value
     * @return Collection
     */
    public function getAllByField($value): Collection;
}