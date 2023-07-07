<?php
declare(strict_types=1);

namespace Piboutique\SimpleCMS\Repositories;

use Carbon\Carbon;
use Piboutique\SimpleCMS\Models\Portfolio;
use Piboutique\SimpleCMS\Models\Post;
use Piboutique\SimpleCMS\Models\Image;
use Illuminate\Foundation\Http\FormRequest;
use Piboutique\SimpleCMS\Repositories\Interfaces\UpdateModelInterface;

/**
 * Class PageRepository
 * @package App\Repositories
 */
class UpdateItemRepository implements UpdateModelInterface
{
    /**
     * @var
     */
    protected $item;

    /**
     * @inheritDoc
     */
    public function setModel(int $modelId)
    {
        $this->item = Portfolio::findOrFail($modelId);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function handle(FormRequest $request): bool
    {
        $this->item->rows()->delete();
        $rows = $request->only('rows');
        if (isset($rows['rows'])) {
            (new UpdateRowRepository($this->item))->handle($rows['rows']);
        }

        $this->updateImage($request->get('image_id', null));

        return $this->item->fill($request->only('title', 'website', 'description', 'client', 'url', 'slug'))->save();
    }

    /**
     * @param $imageId
     * @return void
     */
    protected function updateImage($imageId)
    {
        if (is_null($imageId)) {
            return;
        }

        $image = Image::find($imageId);
        if (is_null($image)) {
            return;
        }

        $this->item->images()->detach();
        $this->item->images()->save($image, ['featured' => true]);
    }
}