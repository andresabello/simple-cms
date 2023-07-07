<?php /** @noinspection PhpMissingStrictTypesDeclarationInspection */

namespace Piboutique\SimpleCMS\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * Class Page
 * @package App
 */
class Row extends Model
{

    /**
     * @var array
     */
    protected $fillable = ['background_color', 'text_color', 'columns', 'order', 'class'];

    /**
     * @return HasMany
     */
    public function divisions()
    {
        return $this->hasMany(Column::class);
    }

    /**
     * @return MorphTo
     */
    public function rowable()
    {
        return $this->morphTo('rowable','model_type','model_id');
    }
}
