<?php
declare(strict_types=1);

namespace Piboutique\SimpleCMS\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Piboutique\SimpleCMS\Repositories\Interfaces\GetModelInterface;

/**
 * Class PageRepository
 * @package App\Repositories
 */
class PageRepository implements GetModelInterface
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
        return $this->startQuery()->where('pages.id', $pageId)->first();
    }

    /**
     * @inheritDoc
     */
    public function getAll(int $offset = 0): Collection
    {
        return $this->startQuery()
            ->limit($this->limit)
            ->offset($this->offset)
            ->get();
    }

    /**
     * @inheritDoc
     */
    public function getByField($value): \stdClass
    {
        $page = $this->startQuery()->where($this->field, $value)->first();
        if (!$page) {
            return new \stdClass();
        }

        return $page;
    }

    /**
     * @inheritDoc
     */
    public function getAllByField($value): Collection
    {
        return $this->startQuery()->where($this->field, $value)
            ->limit($this->limit)
            ->offset($this->offset)
            ->get();
    }

    protected function startQuery()
    {
        return DB::table('pages')->select(\DB::raw('pages.id as id, pages.title as title, pages.url, pages.template, images.title as image_title, file_path, images.url as image_url, pages.depth, pages.parent_id, pages.order, images.id as image_id, pages.hidden, pages.name'))
            ->leftJoin('imageables', 'pages.id', '=', 'imageables.imageable_id')
            ->leftJoin('images', 'imageables.image_id', '=', 'images.id');
    }
}
