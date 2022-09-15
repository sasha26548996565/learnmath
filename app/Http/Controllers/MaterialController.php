<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\DTO\MaterialDTO;
use App\Models\Category;
use App\Models\Material;
use App\Services\MaterialService;
use App\Services\ServiceContract;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\MaterialRequest;

class MaterialController extends Controller
{
    private MaterialService $materialService;

    public function __construct(MaterialService $materialService)
    {
        $this->materialService = $materialService;
    }

    public function show(string $slug): View
    {
        $material = Material::where('slug', $slug)->first();

        return view('material.show', compact('material'));
    }

    public function create(): View
    {
        $categories = Category::latest()->get();

        return view('material.form', compact('categories'));
    }

    public function store(MaterialRequest $request): RedirectResponse
    {
        $material = $this->materialService->store(new MaterialDTO($request->validated()));
        return to_route('material.show', $material->slug);
    }

    public function edit(string $slug): View
    {
        $material = Material::where('slug', $slug)->first();
        $categories = Category::latest()->get();

        return view('material.form', compact('material', 'categories'));
    }

    public function update(MaterialRequest $request, Material $material): RedirectResponse
    {
        $this->materialService->update(new MaterialDTO($request->validated()), $material);
        return to_route('material.show', $material->slug);
    }

    public function destroy(Material $material): RedirectResponse
    {
        $material->delete();
        return to_route('index');
    }
}
