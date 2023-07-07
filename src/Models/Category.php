<?php /** @noinspection PhpMissingStrictTypesDeclarationInspection */

namespace Piboutique\SimpleCMS\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Category
 * @package App
 */
class Category extends Model
{
    /**
     * @var string
     */
    protected $table = 'categories';

    /**
     * @var array
     */
    protected $fillable = ['name', 'content'];

    /**
     * @return BelongsToMany
     */
    public function items()
    {
        return $this->belongsToMany(Portfolio::class, 'items_categories', 'item_id', 'category_id');
    }

    /**
     * @param $value
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value ?: null;
    }
}
