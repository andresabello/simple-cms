<?php
declare(strict_types=1);

namespace Piboutique\SimpleCMS\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Piboutique\SimpleCMS\Models\Image;
use Piboutique\SimpleCMS\Repositories\Interfaces\GetModelInterface;

/**
 * Class PageRepository
 * @package App\Repositories
 */
class ImageRepository implements GetModelInterface
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
    private $limit = 9;

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
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getById(int $imageId): \stdClass
    {
        return Image::where('images.id', $imageId)
            ->leftJoin('imageables', 'images.id', '=', 'imageables.imageable_id')
            ->leftJoin('images', 'imageables.image_id', '=', 'images.id')
            ->select(\DB::raw('images.id, images.title, images.description, images.file_path, images.url'))
            ->first();
    }

    /**
     * @inheritDoc
     */
    public function getAll(int $offset = 0): Collection
    {
        return DB::table('images')->leftJoin('imageables', 'images.id', '=', 'imageables.imageable_id')
            ->select(\DB::raw('images.id, images.title, images.description, images.file_path, images.url, images.alt, images.caption'))
            ->limit($this->limit)
            ->offset($this->offset)
            ->get();
    }

    /**
     * @inheritDoc
     */
    public function getByField($value): \stdClass
    {
        return Image::where($this->field, $value)
            ->leftJoin('imageables', 'images.id', '=', 'imageables.imageable_id')
            ->leftJoin('images', 'imageables.image_id', '=', 'images.id')
            ->select(\DB::raw('images.id as image_id, images.title as image_title, images.description, images.content, images.template, images.title as image_title, images.filePath, images.url as image_url'))
            ->first();
    }

    /**
     * @inheritDoc
     */
    public function getAllByField($value): Collection
    {
        return Image::where($this->field, $value)
            ->leftJoin('imageables', 'images.id', '=', 'imageables.imageable_id')
            ->leftJoin('images', 'imageables.image_id', '=', 'images.id')
            ->select(\DB::raw('images.id as image_id, images.title as image_title, images.description, images.content, images.template, images.title as image_title, images.filePath, images.url as image_url'))
            ->limit($this->limit)
            ->offset($this->offset)
            ->get();
    }
}