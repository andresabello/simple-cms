<?php
declare(strict_types=1);

namespace App\Repositories;

use Piboutique\SimpleCMS\Models\Portfolio;
use Illuminate\Support\Collection;
use Piboutique\SimpleCMS\Repositories\Interfaces\GetModelInterface;

/**
 * Class PortfolioRepository
 * @package App\Repositories
 */
class PortfolioRepository implements GetModelInterface
{
    /**
     * @var
     */
    private $field;

    /**
     * @var
     */
    private $offset;

    /**
     * @var int
     */
    private $limit = 25;

    /**
     * @param $field
     * @return GetModelInterface
     */
    public function setField($field): GetModelInterface
    {
        $this->field = $field;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setOffset(int $offset): GetModelInterface
    {
        $this->offset = $offset;
    }

    /**
     * @inheritDoc
     */
    public function getById(int $pageId): \stdClass
    {
        return Portfolio::where('items.id', $pageId)
            ->leftJoin('imageables', 'items.id', '=', 'imageables.imageable_id')
            ->leftJoin('images', 'imageables.image_id', '=', 'images.id')
            ->select(\DB::raw('items.id as item_it, items.title as item_title, items.url, items.description, items.client, images.title as image_title, filePath, images.url as image_url, items.rgt, items.lft, images.id as image_id, items.slug, items.image_id as featured_image'))
            ->first();
    }

    /**
     * @inheritDoc
     */
    public function getAll(int $offset = 0): Collection
    {
        return Portfolio::leftJoin('imageables', 'items.id', '=', 'imageables.imageable_id')
            ->leftJoin('images', 'imageables.image_id', '=', 'images.id')
            ->select(\DB::raw('items.id as item_it, items.title as item_title, items.url, items.description, items.client, images.title as image_title, filePath, images.url as image_url, items.rgt, items.lft, images.id as image_id, items.slug, items.image_id as featured_image'))
            ->limit($this->limit)
            ->offset($this->offset)
            ->get();
    }

    /**
     * @inheritDoc
     */
    public function getByField($value): \stdClass
    {
        return Portfolio::where($this->field, $value)
            ->leftJoin('imageables', 'items.id', '=', 'imageables.imageable_id')
            ->leftJoin('images', 'imageables.image_id', '=', 'images.id')
            ->select(\DB::raw('items.id as item_it, items.title as item_title, items.url, items.description, items.client, images.title as image_title, filePath, images.url as image_url, items.rgt, items.lft, images.id as image_id, items.slug, items.image_id as featured_image'))
            ->first();
    }

    /**
     * @inheritDoc
     */
    public function getAllByField($value): Collection
    {
        return Portfolio::where($this->field, $value)
            ->leftJoin('imageables', 'items.id', '=', 'imageables.imageable_id')
            ->leftJoin('images', 'imageables.image_id', '=', 'images.id')
            ->select(\DB::raw('items.id as item_it, items.title as item_title, items.url, items.description, items.client, images.title as image_title, filePath, images.url as image_url, items.rgt, items.lft, images.id as image_id, items.slug, items.image_id as featured_image'))
            ->limit($this->limit)
            ->offset($this->offset)
            ->get();
    }
}