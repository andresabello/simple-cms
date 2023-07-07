<?php

namespace Piboutique\SimpleCMS\Http\Controllers\Backend;

use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\File;
use Illuminate\Contracts\View\Factory;
use Piboutique\SimpleCMS\Services\ThemeService;
use Piboutique\SimpleCMS\Http\Requests\UpdateStyleOptionsRequest;
use Piboutique\SimpleCMS\Http\Requests\StoreStyleOptionsRequest;

/**
 * Class PageController
 * @package Piboutique\SimpleCMS\Http\Controllers\Backend
 */
class StyleOptionsController
{

    /**
     * @var string
     */
    protected $path;

    /**
     * @var string
     */
    protected $backup;

    /**
     * StyleOptionsController constructor.
     * @param ThemeService $themeService
     */
    public function __construct(ThemeService $themeService)
    {
        $this->path = $themeService->findAssetPath('scss/styles.scss');
        $this->backup = $themeService->findAssetPath('scss/styles_backup.scss');
    }

    /**
     * Display a listing of the resource
     *
     * @return Factory|JsonResponse|View
     */
    public function index()
    {
        try {
            $code = File::get($this->path);
            if (empty($code)) {
                $code = File::get($this->backup);
            }
            return response()->json([
                'code' => $code
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ], 404);
        }

    }

    /**
     * Store newly created resource in storage
     *
     * @param StoreStyleOptionsRequest $request
     * @return JsonResponse
     */
    public function store(StoreStyleOptionsRequest $request)
    {
        $code = $request->get('code');

        try {
            File::put($this->path, $code);
            File::put($this->backup, $code);
            return response()->json([
                'message' => 'styles created',
                'code' => $code
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
            ], 404);
        }
    }

    /**
     * Update a new page
     *
     * @param UpdateStyleOptionsRequest $request
     * @return JsonResponse
     */
    public function update(UpdateStyleOptionsRequest $request)
    {
        $code = $request->get('code');

        try {
            File::put($this->path, $code);
            File::put($this->backup, $code);
            return response()->json([
                'message' => 'styles updated',
                'code' => $code
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
            ], 404);
        }
    }

    /**
     * Remove page from storage
     *
     * @return JsonResponse
     */
    public function destroy()
    {

        try {
            File::delete($this->path);
            File::delete($this->backup);
            return response()->json([
                'message' => 'styles deleted',
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
            ], 404);
        }
    }
}