<?php

namespace Piboutique\SimpleCMS\Http\Controllers\Backend;

use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\File;
use Piboutique\SimpleCMS\Models\Video;
use Illuminate\Contracts\View\Factory;
use Piboutique\SimpleCMS\Http\Requests\StoreVideoRequest;
use Piboutique\SimpleCMS\Http\Requests\UpdateVideoRequest;

class VideoController
{

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
                'images' => Video::where('id', '!=', null)->paginate(9)
            ]);
        }

        return view('vendor.simple-cms.backend.videos.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreVideoRequest $request
     * @return JsonResponse
     */
    public function store(StoreVideoRequest $request)
    {
        if (!$request->isXmlHttpRequest()) {
            return response()->json(['message' => 'invalid request'], 404);
        }

        try {
            //create video store on database
            $video = [];
            return response()->json([
                'message' => 'Video Uploaded',
                'video' => $video
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
     * @param UpdateVideoRequest $request
     * @param $videoId
     * @return JsonResponse
     */
    public function update(UpdateVideoRequest $request, $videoId)
    {
        $image = Video::findOrFail($videoId);
        $image->fill($request->all())->save();

        return response()->json([
            'message' => 'Video Updated',
            'image' => Video::find($videoId)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param $videoId
     * @return JsonResponse
     */
    public function destroy($videoId)
    {
        $video = Video::findOrFail($videoId);
        File::delete($video->file_path);
        $video->delete();
        return response()->json([
            'message' => 'Video Deleted'
        ]);
    }
}
