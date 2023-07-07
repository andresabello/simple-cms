<?php
declare(strict_types=1);

namespace Piboutique\SimpleCMS\Repositories;

use Carbon\Carbon;
use Piboutique\SimpleCMS\Models\Post;
use Piboutique\SimpleCMS\Models\Image;
use Illuminate\Foundation\Http\FormRequest;
use Piboutique\SimpleCMS\Repositories\Interfaces\UpdateModelInterface;

/**
 * Class PageRepository
 * @package App\Repositories
 */
class UpdatePostRepository implements UpdateModelInterface
{
    /**
     * @var
     */
    protected $post;

    /**
     * @inheritDoc
     */
    public function setModel(int $modelId)
    {
        $this->post = Post::findOrFail($modelId);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function handle(FormRequest $request): bool
    {
        $this->post->rows()->delete();
        $rows = $request->only('rows');
        if (isset($rows['rows'])) {
            (new UpdateRowRepository($this->post))->handle($rows['rows']);
        }

        if ($request->has('published_at')) {
            $this->post->update([
                'published_at' => Carbon::make($request->get('published_at'))
            ]);
        }

        $this->updateImage($request->get('image', null));

        return $this->post->fill($request->only('title', 'sub_title', 'slug', 'excerpt'))->save();
    }

    /**
     * @param $image
     * @return void
     */
    protected function updateImage($image)
    {
        if (is_null($image['id'])) {
            return;
        }

        $image = Image::find($image['id']);
        if (is_null($image)) {
            return;
        }

        $this->post->images()->detach();
        $this->post->images()->save($image, ['featured' => true]);
    }
}