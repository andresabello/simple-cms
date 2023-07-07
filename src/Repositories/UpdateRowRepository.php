<?php
declare(strict_types=1);

namespace Piboutique\SimpleCMS\Repositories;

use Illuminate\Support\Facades\DB;
use Piboutique\SimpleCMS\Models\Image;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PageRepository
 * @package App\Repositories
 */
class UpdateRowRepository
{
    /**
     * @var Model
     */
    protected $parentModel;

    /**
     * UpdateRowRepository constructor.
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->parentModel = $model;
    }

    /**
     * @param array $rows
     */
    public function handle(array $rows): void
    {
        foreach ($rows as $i => $row) {
            $newRow = $this->parentModel->rows()->create([
                'background_color' => $row['bgPicker']['value'],
                'text_color' => $row['colorPicker']['value'],
                'columns' => count($row['columns']),
                'order' => $i,
                'class' => $row['class'] ?? null,
            ]);
            foreach ($row['columns'] as $j => $column) {
                $newColumn = $newRow->divisions()->create([
                    'type' => $column['type'],
                    'content' => $column['content'],
                    'order' => $j,
                    'class' => $column['class'] ?? null,
                ]);

                if (isset($column['image_id'])) {
                    $image = Image::find($column['image_id']);
                    $newColumn->images()->save($image);
                }

                if (isset($column['slider_images']) && count($column['slider_images']) > 0) {
                    $newColumn->images()->detach();
                    foreach ($column['slider_images'] as $index => $image) {
                        $dbImage = Image::find($image['id']);
                        if (!$dbImage) {
                            continue;
                        }

                        $newColumn->images()->attach([
                            $dbImage->id => [
                                'order' => $index
                            ]
                        ]);
                    }
                }
            }
        }
    }
}
