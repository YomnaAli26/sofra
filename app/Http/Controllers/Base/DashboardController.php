<?php

namespace App\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\{Factory,View};
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    protected $storeRequestClass;
    protected $updateRequestClass;
    protected $baseFolder = 'admin.';
    protected $indexView;
    protected $createView;
    protected $editView;
    protected $showView;
    protected $sharedData = [];
    protected $createData = [];
    protected $editData = [];
    protected $indexData = [];

    protected $successMessage;
    protected $relations = [];
    protected $usePagination;
    protected bool $useFilter = false;
    protected $perPage;
    protected $partialFolder;

    public function __construct(public $service)
    {
    }

    public function index(): Factory|Application|View|string
    {
        $data = $this->service->getData($this->relations,$this->usePagination,$this->perPage,$this->useFilter);
        if (request()->ajax())
        {
            return view("{$this->baseFolder}.{$this->partialFolder}.partials.{$this->partialFolder}_table", compact('data'))->render();
        }
        return view("{$this->baseFolder}{$this->indexView}", compact('data'), array_merge($this->indexData,$this->sharedData));
    }

    public function create(): View|Factory|Application
    {
        return view("{$this->baseFolder}{$this->createView}", $this->createData, $this->sharedData);

    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate($this->storeRequestClass->rules());
        $this->service->storeResource($validatedData);
        return to_route("{$this->baseFolder}{$this->indexView}")
            ->with('success', $this->successMessage);
    }

    public function show($id): View|Factory|Application
    {
        $model = $this->service->showResource($id);
        return view("{$this->baseFolder}{$this->showView}", compact("model"),$this->sharedData);

    }

    public function edit($id): View|Factory|Application
    {
        $model = $this->service->showResource($id);
        return view("{$this->baseFolder}{$this->editView}", compact('model'), array_merge($this->editData, $this->sharedData));

    }

    public function update(Request $request, $id): RedirectResponse
    {
        $validatedData = $request->validate($this->updateRequestClass->rules($id));
        $this->service->updateResource($id,$validatedData);
        return to_route("{$this->baseFolder}{$this->indexView}")
            ->with('success', $this->successMessage);
    }

    public function destroy($id): RedirectResponse
    {
        $this->service->deleteResource($id);
        return to_route("{$this->baseFolder}{$this->indexView}")
            ->with('success', $this->successMessage);
    }

}
