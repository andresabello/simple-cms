<?php
declare(strict_types=1);

namespace Piboutique\SimpleCMS\Repositories;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Piboutique\SimpleCMS\Models\Post;
use Piboutique\SimpleCMS\Models\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Piboutique\SimpleCMS\Repositories\Interfaces\CreateModelInterface;

/**
 * Class PageRepository
 * @package App\Repositories
 */
class CreatePostRepository implements CreateModelInterface
{
    /**
     * @inheritDoc
     */
    public function handle(FormRequest $request): Model
    {
        $data = $request->except('rows', 'published_at');
        if (!isset($data['slug']) || $data['slug'] === '') {
            $data['slug'] = Str::slug($data['title']);
        }
        $data['author_id'] = $request->user()->id;
        $rows = $request->only('rows');

        $post = Post::create($data);

        if ($request->has('published_at')) {
            $post->update([
                'published_at' => Carbon::make($request->get('published_at'))
            ]);
        }

        if ($request->has('image')) {
            $this->updateImage($post, $request->get('image', null));
        }

        if (isset($rows['rows'])) {
            (new UpdateRowRepository($post))->handle($rows['rows']);
        }
        return $post;
    }


    /**
     * @param $post
     * @param $image
     * @return void
     */
    protected function updateImage($post, $image)
    {
        if (is_null($image['id'])) {
            return;
        }

        $image = Image::find($image['id']);
        if (is_null($image)) {
            return;
        }

        $post->images()->detach();
        $post->images()->save($image, ['featured' => true]);
    }
}