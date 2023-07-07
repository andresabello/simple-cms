<?php

namespace Piboutique\SimpleCMS\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Post
 * @package App
 */
class Post extends Model
{
    /**
     * @var string
     */
    protected $leftColumn = 'lft';

    /**
     * @var string
     */
    protected $rightColumn = 'rgt';

    /**
     * @var array
     */
    protected $fillable = ['author_id', 'title', 'slug', 'body', 'excerpt', 'published_at'];

    /**
     * @var array
     */
    protected $dates = ['published_at'];

    /**
     * @param $value
     */
    public function setPublishedAttribute($value)
    {
        $this->attributes['published_at'] = $value ?: null;
    }

    /**
     * @return BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'posts_categories', 'post_id', 'category_id');
    }

    /**
     * @return MorphToMany
     */
    public function videos()
    {
        return $this->morphToMany(Video::class, 'videoable');
    }

    /**
     * @return MorphToMany
     */
    public function images()
    {
        return $this->morphToMany(Image::class, 'imageable');
    }

    /**
     * @return MorphMany
     */
    public function rows()
    {
        return $this->morphMany(Row::class, 'rowable', 'model_type', 'model_id');
    }
}
