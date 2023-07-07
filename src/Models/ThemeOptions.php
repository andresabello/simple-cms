<?php /** @noinspection PhpMissingStrictTypesDeclarationInspection */

namespace Piboutique\SimpleCMS\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * Class Page
 * @package App
 */
class ThemeOptions extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['type', 'name', 'value'];

    /**
     * @return MorphToMany
     */
    public function images()
    {
        return $this->morphToMany(Image::class, 'imageable');
    }
}
