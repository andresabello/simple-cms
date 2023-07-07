<?php

namespace Piboutique\SimpleCMS\Http\Controllers\Backend;

use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Piboutique\SimpleCMS\Models\Row;
use Piboutique\SimpleCMS\Models\Post;
use Illuminate\Contracts\View\Factory;
use Piboutique\SimpleCMS\Models\Column;
use Piboutique\SimpleCMS\Repositories\PostRepository;
use Piboutique\SimpleCMS\Http\Requests\StorePostRequest;
use Piboutique\SimpleCMS\Http\Requests\UpdatePostRequest;
use Piboutique\SimpleCMS\Repositories\CreatePostRepository;
use Piboutique\SimpleCMS\Repositories\UpdatePostRepository;

/**
 * Class PostController
 * @package Piboutique\SimpleCMS\Http\Controllers\Backend
 */
class PostController
{
    /**
     * @var PostRepository
     */
    protected $postRepository;

    /**
     * @var CreatePostRepository
     */
    protected $createPostRepository;

    /**
     * @var UpdatePostRepository
     */
    protected $updatePostRepository;

    /**
     * PagesController constructor.
     * @param PostRepository $postRepository
     * @param CreatePostRepository $createPostRepository
     * @param UpdatePostRepository $updatePostRepository
     */
    public function __construct(
        PostRepository $postRepository,
        CreatePostRepository $createPostRepository,
        UpdatePostRepository $updatePostRepository)
    {
        $this->postRepository = $postRepository;
        $this->createPostRepository = $createPostRepository;
        $this->updatePostRepository = $updatePostRepository;
    }

    /**
     * Display a listing of the resource
     *
     * @return Factory|View
     */
    public function index()
    {
        return view('vendor.simple-cms.backend.posts.index', [
            'posts' => Post::paginate(25)
        ]);
    }

    /**
     * Create a new page
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('vendor.simple-cms.backend.posts.form');
    }

    /**
     * Store newly created resource in storage
     *
     * @param StorePostRequest $request
     * @return JsonResponse
     */
    public function store(StorePostRequest $request)
    {
        $post = $this->createPostRepository->handle($request);
        return response()->json([
            'message' => 'post created',
            'post' => $post
        ]);
    }

    /**
     * Create a new page
     *
     * @param $postId
     * @return Factory|View
     */
    public function edit($postId)
    {
        $post = DB::table('posts')
            ->where('posts.id', $postId)
            ->select(DB::raw('posts.id as id, posts.author_id, posts.slug, posts.title, posts.sub_title, posts.excerpt, posts.published_at'))
            ->first();

        $featureImage = DB::table('images')
            ->leftJoin('imageables', 'imageables.image_id', '=', 'images.id')
            ->leftJoin('posts', 'posts.id', '=', 'imageables.imageable_id')
            ->where('imageables.featured', true)
            ->where('imageables.imageable_id', $post->id)
            ->first();

        if ($featureImage) {
            $post->image = $featureImage;
        }

        $rows = Row::where('model_id', $postId)
            ->where('model_type', 'Piboutique\SimpleCMS\Models\Post')
            ->orderBy('order')
            ->get();

        $post->rows = [];
        foreach ($rows as $row) {
            $row = $row->toArray();
            $row['columns'] = [];
            $row['colorPicker']['value'] = $row['text_color'];
            $row['bgPicker']['value'] = $row['background_color'];
            $row['options'] = false;
            $row['active'] = false;
            $columns = Column::where('row_id', $row['id'])->get();
            foreach ($columns as $column) {
                if ($column->type === 'image') {
                    $image = $column->images()->where('imageable_id', $column->id)->first();
                    $column->content = url($image->url);
                    $column->image_id = $image->id;
                }
                $column->active = false;
                array_push($row['columns'], $column);
            }
            array_push($post->rows, $row);
        }
        return view('vendor.simple-cms.backend.posts.form', [
            'post' => $post
        ]);
    }

    /**
     * Store newly created resource in storage
     *
     * @param UpdatePostRequest $request
     * @param $postId
     * @return JsonResponse
     */
    public function update(UpdatePostRequest $request, $postId)
    {
        $post = $this->updatePostRepository->setModel($postId)->handle($request);
        return response()->json([
            'message' => 'post updated',
            'post' => $post
        ]);
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json([
            'message' => 'post deleted'
        ]);
    }
}