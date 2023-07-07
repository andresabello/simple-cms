<?php
declare(strict_types=1);

namespace Piboutique\SimpleCMS\Repositories;

use Illuminate\Support\Str;
use Piboutique\SimpleCMS\Models\Page;
use Illuminate\Foundation\Http\FormRequest;
use Piboutique\SimpleCMS\Repositories\Interfaces\UpdateModelInterface;

/**
 * Class PageRepository
 * @package App\Repositories
 */
class UpdatePageRepository implements UpdateModelInterface
{
    protected $page;

    /**
     * @inheritDoc
     */
    public function setModel(int $modelId)
    {
        $this->page = Page::findOrFail($modelId);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function handle(FormRequest $request): bool
    {
        $data = $request->only('title', 'url', 'name', 'template', 'hidden');
        $data['url'] = Str::slug($data['url']);
        $this->removeRowsAndColumns();

        $rows = $request->only('rows');
        if (isset($rows['rows'])) {
            (new UpdateRowRepository($this->page))->handle($rows['rows']);
        }

        return $this->page->fill($data)->save();
    }

    /**
     *
     */
    private function removeRowsAndColumns()
    {
        $this->page->rows()->each(function ($row) {
            $row->divisions()->each(function ($column) {
                $column->delete();
            });
            $row->delete();
        });
    }
}
