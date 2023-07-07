<?php

namespace Piboutique\SimpleCMS\Http\Controllers\Backend;

use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Piboutique\SimpleCMS\Models\Row;
use Illuminate\Contracts\View\Factory;
use Piboutique\SimpleCMS\Models\Column;
use Piboutique\SimpleCMS\Models\Portfolio;
use Piboutique\SimpleCMS\Http\Requests\StoreItemRequest;
use Piboutique\SimpleCMS\Http\Requests\UpdateItemRequest;
use Piboutique\SimpleCMS\Repositories\CreateItemRepository;
use Piboutique\SimpleCMS\Repositories\UpdateItemRepository;

class PortfolioController
{

    /**
     * Display a listing of the resource
     *
     * @return Factory|View
     */
    public function index()
    {
        return view('vendor.simple-cms.backend.items.index', [
            'items' => Portfolio::paginate(25)
        ]);
    }

    /**
     * Create a new page
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('vendor.simple-cms.backend.items.form');
    }

    /**
     * Store newly created resource in storage
     *
     * @param StoreItemRequest $request
     * @return JsonResponse
     */
    public function store(StoreItemRequest $request)
    {
        $item = (new CreateItemRepository())->handle($request);
        return response()->json([
            'message' => 'item created',
            'item' => $item
        ]);
    }

    /**
     * Create a new page
     *
     * @param $itemId
     * @return Factory|View
     */
    public function edit($itemId)
    {
        $item = DB::table('items')
            ->where('items.id', $itemId)
            ->select(DB::raw('items.id as id, items.title, items.slug, items.url, items.client, items.description, items.website'))
            ->first();

        $featureImage = DB::table('images')
            ->leftJoin('imageables', 'imageables.image_id', '=', 'images.id')
            ->leftJoin('items', 'items.id', '=', 'imageables.imageable_id')
            ->where('imageables.featured', true)
            ->first();

        if ($featureImage) {
            $item->image = $featureImage;
        }

        $rows = Row::where('model_id', $itemId)
            ->where('model_type', 'Piboutique\SimpleCMS\Models\Item')
            ->orderBy('order')
            ->get();

        $item->rows = [];
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
            array_push($item->rows, $row);
        }
        return view('vendor.simple-cms.backend.items.form', [
            'item' => $item
        ]);
    }


    /**
     * Store newly created resource in storage
     *
     * @param UpdateItemRequest $request
     * @param $itemId
     * @return JsonResponse
     */
    public function update(UpdateItemRequest $request, $itemId)
    {
        return response()->json([
            'message' => 'item updated',
            'item' => (new UpdateItemRepository)->setModel($itemId)->handle($request)
        ]);
    }
}