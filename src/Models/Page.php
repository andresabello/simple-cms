<?php /** @noinspection PhpMissingStrictTypesDeclarationInspection */

namespace Piboutique\SimpleCMS\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * Class Page
 * @package App
 */
class Page extends Model
{

    /**
     * @var array
     */
    protected $fillable = ['title', 'name', 'url', 'content', 'template', 'hidden', 'parent_id'];

    /**
     * @return MorphToMany
     */
    public function images()
    {
        return $this->morphToMany(Image::class, 'imageable');
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

    /**
     * @return HasOne
     */
    public function parent()
    {
        return $this->hasOne(Page::class, 'id', 'parent');
    }

    /**
     * @return HasMany
     */
    public function children()
    {
        return $this->hasMany(Page::class, 'parent', 'id');
    }

    /**
     * @param $value
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value ?: null;
    }

    /**
     * @param $value
     */
    public function setTemplateAttribute($value)
    {
        $this->attributes['template'] = $value ?: null;
    }
}
