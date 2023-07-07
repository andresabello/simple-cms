<?php
declare(strict_types=1);

namespace Piboutique\SimpleCMS\Repositories;

use Illuminate\Support\Str;
use Piboutique\SimpleCMS\Models\Portfolio;
use Piboutique\SimpleCMS\Models\Post;
use Piboutique\SimpleCMS\Models\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Piboutique\SimpleCMS\Repositories\Interfaces\CreateModelInterface;

/**
 * Class PageRepository
 * @package App\Repositories
 */
class CreateItemRepository implements CreateModelInterface
{
    /**
     * @inheritDoc
     */
    public function handle(FormRequest $request): Model
    {
        $data = $request->except('rows');
        if (!isset($data['slug']) || $data['slug'] === '') {
            $data['slug'] = Str::slug($data['title']);
        }
        $rows = $request->only('rows');
        $data['client'] = $data['web_client'] ?? null;

        $item = Portfolio::create($data);
        if (isset($rows['rows'])) {
            (new UpdateRowRepository($item))->handle($rows['rows']);
        }
        return $item;
    }
}