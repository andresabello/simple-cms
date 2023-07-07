<?php
declare(strict_types=1);

namespace Piboutique\SimpleCMS\Templates;

use Illuminate\View\View;
use Piboutique\SimpleCMS\Models\Post;
use Piboutique\SimpleCMS\Repositories\PageRepository;

/**
 * Class BlogPostTemplate
 * @package App\Templates
 */
class BlogPostTemplate extends AbstractTemplate
{
    /**
     * @var string
     */
    protected $template = 'post';

    /**
     * @var Post
     */
    protected $posts;

    /**
     * BlogPostTemplate constructor.
     * @param Post $posts
     */
    public function __construct(Post $posts)
    {
        $this->posts = $posts;
    }

    /**
     * @param View $view
     * @param array $parameters
     * @return mixed|void
     */
    public function prepare(array $parameters): View
    {
        $post = $this->posts
            ->where('id', $parameters['id'])
            ->where('slug', $parameters['slug'])
            ->first();

        return $this->view->with('post', $post)->with('parameters', $parameters);
    }
}
