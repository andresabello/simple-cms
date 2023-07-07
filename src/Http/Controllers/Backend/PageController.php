<?php

namespace Piboutique\SimpleCMS\Http\Controllers\Backend;


use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Redirector;
use Piboutique\SimpleCMS\Models\Row;
use Piboutique\SimpleCMS\Models\Page;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Piboutique\SimpleCMS\Models\Column;
use Piboutique\SimpleCMS\Presenters\PagePresenter;
use Piboutique\SimpleCMS\Repositories\PageRepository;
use Piboutique\SimpleCMS\Http\Requests\StorePageRequest;
use Piboutique\SimpleCMS\Http\Requests\UpdatePageRequest;
use Piboutique\SimpleCMS\Repositories\CreatePageRepository;
use Piboutique\SimpleCMS\Repositories\UpdatePageRepository;

/**
 * Class PageController
 * @package Piboutique\SimpleCMS\Http\Controllers\Backend
 */
class PageController
{
    /**
     * @var PageRepository
     */
    protected $pageRepository;

    /**
     * @var CreatePageRepository
     */
    private $createPageRepository;

    /**
     * @var UpdatePageRepository
     */
    private $updatePageRepository;

    /**
     * PagesController constructor.
     * @param PageRepository $pageRepository
     * @param CreatePageRepository $createPageRepository
     * @param $updatePageRepository
     */
    public function __construct(
        PageRepository       $pageRepository,
        CreatePageRepository $createPageRepository,
        UpdatePageRepository $updatePageRepository
    )
    {
        $this->pageRepository = $pageRepository;
        $this->createPageRepository = $createPageRepository;
        $this->updatePageRepository = $updatePageRepository;
    }

    /**
     * Display a listing of the resource
     *
     * @return Factory|View
     */
    public function index()
    {
        return view('vendor.simple-cms.backend.pages.index', [
            'pages' => Page::paginate(25)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @param array $parameters
     * @return Factory|View
     */
    public function show($id, array $parameters)
    {
        $page = $this->pageRepository->getById($id);
        $this->prepareTemplate($page, $parameters);
        return view('page', ['page' => $page]);
    }

    /**
     * Create a new page
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('vendor.simple-cms.backend.pages.form', [
            'templates' => json_encode(array_values((array)$this->getPageTemplates())),
            'orderPages' => $this->pageRepository->setField('hidden')->getAllByField(false)
        ]);
    }

    /**
     * Store newly created resource in storage
     *
     * @param StorePageRequest $request
     * @return JsonResponse
     */
    public function store(StorePageRequest $request)
    {
        $page = $this->createPageRepository->handle($request);
        //todo update the order and parent
        return response()->json([
            'message' => 'page created',
            'page' => $page
        ]);
    }

    /**
     * Create a new page
     *
     * @param $pageId
     * @return View
     */
    public function edit($pageId)
    {
        $page = $this->pageRepository->getById($pageId);
        $rows = Row::where('model_id', $pageId)
            ->where('model_type', 'Piboutique\SimpleCMS\Models\Page')
            ->orderBy('order')
            ->get();

        $page->rows = [];
        foreach ($rows as $row) {
            $row = $row->toArray();
            $row['columns'] = [];
            $row['colorPicker']['value'] = $row['text_color'];
            $row['bgPicker']['value'] = $row['background_color'];
            $row['options'] = false;
            $row['active'] = false;
            $columns = Column::where('row_id', $row['id'])->get();
            foreach ($columns as $column) {
                $column->slider_images = [];
                $column->active = false;
                if ($column->type === 'image') {
                    $image = $column->images()->where('imageable_id', $column->id)->first();
                    $column->content = isset($image) ? url($image->url) : null;
                    $column->image_id = $image->id ?? null;
                }

                if ($column->type === 'slider') {
                    $images = $column->images()->where('imageable_id', $column->id)->get();
                    $column->slider_images = $images;
                }

                array_push($row['columns'], $column);
            }
            array_push($page->rows, $row);
        }

        $templates = $this->getPageTemplates();
        return view('vendor.simple-cms.backend.pages.form', [
            'page' => $page,
            'templates' => json_encode((array)array_values($templates)),
            'orderPages' => json_encode((new PagePresenter())->paddedTitle()),
        ]);
    }

    /**
     * Update a new page
     *
     * @param UpdatePageRequest $request
     * @param $pageId
     * @return JsonResponse
     */
    public function update(UpdatePageRequest $request, $pageId)
    {
        $page = $this->updatePageRepository->setModel($pageId)->handle($request);
        //todo update the order and parent
        return response()->json([
            'message' => 'page update',
            'page' => $page
        ]);
    }

    /**
     * Remove page from storage
     *
     * @param int $id
     * @return RedirectResponse|Redirector
     */
    public function destroy($id)
    {
        $page = $this->pages->findOrFail($id);

        foreach ($page->children as $child) {
            $child->makeRoot();
        }

        $page->delete();

        return redirect(route('pages.index'))->with('status', 'Page Deleted!');
    }

    /**
     * @return array|false
     */
    protected function getPageTemplates()
    {
        $templates = config('cms.templates');
        return ['' => ''] + array_combine(array_keys($templates), array_keys($templates));
    }


    /**
     * @param $page
     * @param array $parameters
     * @return Page|void
     */
    private function prepareTemplate($page, array $parameters)
    {
        $templates = config('cms.templates');
        if (!$page->template || !isset($templates[$page->template])) {
            return;
        }

        $template = app($templates[$page->template]);
        $view = sprintf('templates.%s', $template->getView());

        if (!view()->exists($view)) {
            return;
        }

        $view = view($view);
        $template->prepare($view, $parameters);
        $page->view = $view;
    }
}
