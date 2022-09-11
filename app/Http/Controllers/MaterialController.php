<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\MaterialRequest;
use App\Models\Category;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class MaterialController extends Controller
{
    public function show(string $slug): View
    {
        $material = Material::where('slug', $slug)->first();

        return view('material.show', compact('material'));
    }

    public function create(): View
    {
        $categories = Category::latest()->get();

        return view('material.create', compact('categories'));
    }

    public function store(MaterialRequest $request): RedirectResponse
    {
        $material = Material::create($request->validated());

        return to_route('material.show', $material->slug);
    }
}
