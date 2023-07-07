<?php

namespace Piboutique\SimpleCMS\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Image
 * @package App
 */
class Image extends Model
{
    /**
     * @var string
     */
    protected $table = 'images';

    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'url',
        'file_path',
        'alt',
        'caption'
    ];

    /**
     */
    public function pages()
    {
        return $this->morphedByMany(Page::class, 'imageable');
    }

    /**
     */
    public function posts()
    {
        return $this->morphedByMany(Post::class, 'imageable');
    }

    /**
     */
    public function items()
    {
        return $this->morphedByMany(Portfolio::class, 'imageable');
    }

    /**
     */
    public function rows()
    {
        return $this->morphedByMany(Row::class, 'imageable');
    }

    /**
     */
    public function columns()
    {
        return $this->morphedByMany(Column::class, 'imageable');
    }

    /**
     */
    public function themeOptions()
    {
        return $this->morphedByMany(ThemeOptions::class, 'imageable');
    }
}
