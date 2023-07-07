<?php

namespace Piboutique\SimpleCMS\Http\Controllers\Backend;

use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\View\Factory;
use Piboutique\SimpleCMS\Models\Image;
use Piboutique\SimpleCMS\Models\ThemeOptions;
use Piboutique\SimpleCMS\Http\Requests\StoreThemeOptionsRequest;
use Piboutique\SimpleCMS\Http\Requests\UpdateThemeOptionsRequest;

/**
 * Class PageController
 * @package Piboutique\SimpleCMS\Http\Controllers\Backend
 */
class ThemeOptionsController
{

    /**
     * Display a listing of the resource
     *
     * @return Factory|JsonResponse|View
     */
    public function index()
    {
        if (request()->ajax()) {
            return response()->json([
                'options' => ThemeOptions::all()
            ]);
        }

        return view('vendor.simple-cms.backend.theme-options.index');
    }

    /**
     * Update a new page
     *
     * @param UpdateThemeOptionsRequest $request
     * @return JsonResponse
     */
    public function update(UpdateThemeOptionsRequest $request): JsonResponse
    {
        $options = $request->get('options');

        foreach ($options as $option) {
            $foundOption = ThemeOptions::find($option['id']);
            if (empty($foundOption)) continue;

            if ($option['type'] === 'image') {
                $image = Image::where('url', substr($option['value'], 1))->first();
                if (is_null($image)) continue;
                $foundOption->update(['value' => $option['value']]);
                $image->themeOptions()->save($foundOption);
                continue;
            }

            $foundOption->update(['value' => $option['value']]);

        }

        return response()->json([
            'message' => 'option updated',
            'options' => $options
        ]);
    }

    /**
     * Remove page from storage
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $option = ThemeOptions::findOrFail($id);

        try {
            $option->delete();
            return response()->json([
                'message' => 'option deleted',
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
            ], 404);
        }
    }
}
