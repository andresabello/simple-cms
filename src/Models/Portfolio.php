<?php

namespace Piboutique\SimpleCMS\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Portfolio
 * @package App
 */
class Portfolio extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'items';

    /**
     * @var array
     */
    protected $fillable = ['title', 'website', 'description', 'client', 'url', 'slug', 'image_id'];

    /**
     * @return BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'items_categories', 'item_id', 'category_id');
    }

    /**
     * @param $value
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value ?: null;
    }

    /**
     * @return BelongsTo
     */
    public function client()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return MorphToMany
     */
    public function images()
    {
        return $this->morphedByMany(Post::class, 'imageable');
    }

    /**
     * @return MorphToMany
     */
    public function videos()
    {
        return $this->morphToMany(Video::class, 'videoable');
    }

    /**
     * @return MorphMany
     */
    public function rows()
    {
        return $this->morphMany(Row::class, 'rowable', 'model_type', 'model_id');
    }
}
