<?php

namespace Piboutique\SimpleCMS\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Piboutique\SimpleCMS\Models\Column;

class DetachImageFromColumnController
{
    /**
     * @param Request $request
     * @param $columnId
     * @param $imageId
     * @return JsonResponse
     */
    public function __invoke(Request $request, $columnId, $imageId)
    {
        $column = Column::find($columnId);
        $image = $column->images()->where('images.id', $imageId)->first();
        $message = 'Image detached';
        if (!$image) {
            return response()->json([
                'message' => 'unable to find image'
            ]);
        }

        $imageablesSomewhereElse = DB::table('imageables')
            ->where('imageable_id', '!=', $columnId)
            ->where('image_id', $image->id)
            ->first();

        $column->images()->detach($image->id);

        if (!$imageablesSomewhereElse) {
            $image->delete();
            $message = 'Image detached and deleted';
        }

        return response()->json([
            'column_id' => $columnId,
            'image_id' => $imageId,
            'message' => $message
        ]);
    }
}
