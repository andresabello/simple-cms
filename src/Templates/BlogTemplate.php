<?php
declare(strict_types=1);

namespace Piboutique\SimpleCMS\Templates;

use Carbon\Carbon;
use Illuminate\View\View;
use Piboutique\SimpleCMS\Models\Post;
use Piboutique\SimpleCMS\Models\Image;
use Piboutique\SimpleCMS\Models\Category;
use Piboutique\SimpleCMS\Repositories\PageRepository;
use Piboutique\SimpleCMS\Repositories\PostRepository;

/**
 * Class BlogTemplate
 * @package App\Templates
 */
class BlogTemplate extends AbstractTemplate
{
    /**
     * @var string
     */
    protected $template = 'blog';

    /**
     * @param array $parameters
     * @return View
     */
    public function prepare(array $parameters): View
    {
        $posts = new PostRepository();
        $posts = $posts->getAll();

        foreach ($posts as $post) {
            $foundPost = Post::find($post->id);
            if (!isset($foundPost->images)) continue;

            $post->image = $foundPost->images[0];
        }

        $categories = Category::all();

        return $this->view->with('posts', $posts)
            ->with('categories', $categories)
            ->with('parameters', $parameters);
    }
}
