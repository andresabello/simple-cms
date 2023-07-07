<?php

namespace Piboutique\SimpleCMS\Http\Controllers\Backend;

use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\File;
use Illuminate\Contracts\View\Factory;
use Piboutique\SimpleCMS\Models\Image;
use Piboutique\SimpleCMS\Repositories\ImageRepository;
use Piboutique\SimpleCMS\Http\Requests\StoreImageRequest;
use Piboutique\SimpleCMS\Http\Requests\UpdateImageRequest;
use Piboutique\SimpleCMS\Repositories\CreateImageRepository;

class ImageController
{
    /**
     * @var ImageRepository
     */
    protected $imageRepository;

    /**
     * @var CreateImageRepository
     */
    protected $createImageRepository;

    /**
     * PagesController constructor.
     * @param ImageRepository $imageRepository
     * @param CreateImageRepository $createImageRepository
     */
    public function __construct(ImageRepository $imageRepository, CreateImageRepository $createImageRepository)
    {
        $this->imageRepository = $imageRepository;
        $this->createImageRepository = $createImageRepository;
    }

    /**
     * Display a listing of the resource
     *
     * @return Factory|JsonResponse|View
     */
    public function index()
    {
        if (request()->ajax()) {
            $page = request()->get('page', 0);
            if ($page >= 1) $page = 0;

            return response()->json([
                'images' => Image::where('id', '!=', null)->paginate(9)
            ]);
        }

        return view('vendor.simple-cms.backend.images.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreImageRequest $request
     * @return JsonResponse
     */
    public function store(StoreImageRequest $request)
    {
        if (!$request->isXmlHttpRequest()) {
            return response()->json(['message' => 'invalid request'], 404);
        }

        try {
            $image = $this->createImageRepository->handle($request);
            return response()->json([
                'message' => 'Image Uploaded',
                'image' => $image
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UpdateImageRequest $request
     * @param $imageId
     * @return JsonResponse
     */
    public function update(UpdateImageRequest $request, $imageId)
    {
        $image = Image::findOrFail($imageId);
        $image->fill($request->all())->save();

        return response()->json([
            'message' => 'Image Updated',
            'image' => Image::find($imageId)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param $imageId
     * @return JsonResponse
     */
    public function destroy($imageId)
    {
        $image = Image::findOrFail($imageId);
        File::delete($image->file_path);
        $image->delete();
        return response()->json([
            'message' => 'Image Deleted'
        ]);
    }
}