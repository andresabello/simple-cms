<?php
declare(strict_types=1);

namespace Piboutique\SimpleCMS\Repositories;

use Illuminate\Support\Str;
use Piboutique\SimpleCMS\Models\Image;
use Piboutique\SimpleCMS\Models\Page;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Piboutique\SimpleCMS\Repositories\Interfaces\CreateModelInterface;

/**
 * Class PageRepository
 * @package App\Repositories
 */
class CreatePageRepository implements CreateModelInterface
{
    /**
     * @inheritDoc
     */
    public function handle(FormRequest $request): Model
    {
        $rows = $request->only('rows');
        $data = $request->only('title', 'url', 'name', 'template', 'hidden');
        $data['url'] = Str::slug($data['url']);

        $page = Page::create($data);
        if (isset($rows['rows'])) {
            (new UpdateRowRepository($page))->handle($rows['rows']);
        }
        return $page;
    }
}