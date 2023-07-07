<?php /** @noinspection PhpMissingStrictTypesDeclarationInspection */

namespace Piboutique\SimpleCMS\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * Class Page
 * @package App
 */
class Column extends Model
{

    /**
     * @var array
     */
    protected $fillable = ['row_id', 'type', 'content', 'order', 'class'];

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
     * @return BelongsTo
     */
    public function row()
    {
        return $this->belongsTo(Row::class);
    }
}
