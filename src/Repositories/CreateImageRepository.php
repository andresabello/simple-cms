<?php
declare(strict_types=1);

namespace Piboutique\SimpleCMS\Repositories;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Piboutique\SimpleCMS\Models\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Piboutique\SimpleCMS\Repositories\Interfaces\CreateModelInterface;

/**
 * Class PageRepository
 * @package App\Repositories
 */
class CreateImageRepository implements CreateModelInterface
{
    /**
     * @inheritDoc
     * @throws \Exception
     */
    public function handle(FormRequest $request): Model
    {
        $file = $request->file('file');
        if (!$file) {
            $files = $request->file('files');
            $file = $files[0];
        }

        return $this->createOrGetImage($request, $file);
    }

    /**
     * @param FormRequest $request
     * @param $file
     * @return mixed
     * @throws \Exception
     */
    protected function createOrGetImage(FormRequest $request, UploadedFile $file)
    {
        $imageName = $request->get('name', $file->getClientOriginalName());
        $path = storage_path('app/public/images/');
        $target = $file->move($path, $imageName);

        if (File::exists($imageName)) {
            return Image::where('file_path', $imageName)->first();
        }

        $image = Image::where('title', $imageName)->first();
        if ($image) {
            return $image;
        }

        return Image::create([
            'title' => $imageName,
            'description' => $request->get('description', $imageName),
            'file_path' => $target,
            'url' => 'storage/images/' . $imageName
        ]);
    }
}