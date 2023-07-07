<?php
declare(strict_types=1);

namespace Piboutique\SimpleCMS\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Piboutique\SimpleCMS\Models\Post;
use Piboutique\SimpleCMS\Repositories\Interfaces\GetModelInterface;

/**
 * Class PostRepository
 * @package App\Repositories
 */
class PostRepository implements GetModelInterface
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
    public function getById(int $postId): \stdClass
    {
        return DB::table('posts')->where('posts.id', $postId)
            ->leftJoin('imageables', 'posts.id', '=', 'imageables.imageable_id')
            ->leftJoin('images', 'imageables.image_id', '=', 'images.id')
            ->select(\DB::raw('posts.id as id, posts.author_id, posts.slug, posts.title, posts.sub_title, images.*, posts.excerpt, posts.published_at, images.id as image_id'))
            ->first();
    }

    /**
     * @inheritDoc
     */
    public function getAll(int $offset = 0): Collection
    {
        return DB::table('posts')->select(DB::raw('posts.id, posts.slug, posts.title, posts.excerpt, posts.published_at, users.name as author_name, users.id as user_id'))
            ->leftJoin('users', 'users.id', '=', 'posts.author_id')
            ->limit($this->limit)
            ->offset($this->offset)
            ->get();
    }

    /**
     * @inheritDoc
     */
    public function getByField($value): \stdClass
    {
        return Post::where($this->field, $value)
            ->leftJoin('imageables', 'pages.id', '=', 'imageables.imageable_id')
            ->leftJoin('images', 'imageables.image_id', '=', 'images.id')
            ->select(\DB::raw('posts.id as post_id, posts.author_id, posts.url, posts.slug, posts.title, posts.template, images.title as image_title, filePath, images.url as image_url, posts.body, posts.excerpt, posts.published_at, , images.id as image_id'))
            ->first();
    }

    /**
     * @inheritDoc
     */
    public function getAllByField($value): Collection
    {
        return Post::where($this->field, $value)
            ->leftJoin('imageables', 'pages.id', '=', 'imageables.imageable_id')
            ->leftJoin('images', 'imageables.image_id', '=', 'images.id')
            ->select(\DB::raw('posts.id as post_id, posts.author_id, posts.url, posts.slug, posts.title, posts.template, images.title as image_title, filePath, images.url as image_url, posts.body, posts.excerpt, posts.published_at, , images.id as image_id'))
            ->limit($this->limit)
            ->offset($this->offset)
            ->get();
    }
}