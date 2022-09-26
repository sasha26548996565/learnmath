<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Models\SubscriptionCategory;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::latest()->paginate(15);
        return view('category.index', compact('categories'));
    }

    public function show(string $slug): View
    {
        $category = Category::slug($slug)->first();
        $materials = Material::where('category_id', $category->id)->latest()->paginate(10);

        return view('category.show', compact('category', 'materials'));
    }

    public function create(): View
    {
        return view('category.form');
    }

    public function store(CategoryRequest $request): RedirectResponse
    {
        $category = Category::create($request->validated());
        return to_route('category.show', $category->slug);
    }

    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();
        $category->materials()->delete();

        return to_route('category.index');
    }

    public function subscription(Category $category): RedirectResponse
    {
        SubscriptionCategory::create(['category_id' => $category->id, 'user_id' => Auth::user()->id]);
        return to_route('category.index');
    }
}
