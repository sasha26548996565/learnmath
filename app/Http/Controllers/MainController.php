<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Filters\MaterialFilter;

class MainController extends Controller
{
    public function index(Request $request): View
    {
        $filter = app()->make(MaterialFilter::class, ['queryParams' => array_filter($request->all())]);
        $materials = Material::with('category')->filter($filter)->latest()->paginate(10);

        return view('index', compact('materials'));
    }
}
