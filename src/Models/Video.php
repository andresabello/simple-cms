<?php

namespace Piboutique\SimpleCMS\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * Class Image
 * @package App
 */
class Video extends Model
{
    /**
     * @var string
     */
    protected $table = 'videos';

    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'url',
        'file_path',
    ];

    /**
     * @return MorphToMany
     */
    public function pages()
    {
        return $this->morphedByMany(Page::class, 'imageable');
    }

    /**
     * @return MorphToMany
     */
    public function posts()
    {
        return $this->morphedByMany(Post::class, 'imageable');
    }

    /**
     * @return MorphToMany
     */
    public function items()
    {
        return $this->morphedByMany(Portfolio::class, 'imageable');
    }

    /**
     * @return MorphToMany
     */
    public function columns()
    {
        return $this->morphedByMany(Column::class, 'imageable');
    }
}
