<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class MainController extends Controller
{
    public function index(Request $request): View
    {
        $materialsQuery = Material::query()->with('category')->latest();

        if ($request->has('search'))
            $materialsQuery->where('name', 'LIKE', '%'. $request->search .'%');

        $materials = $materialsQuery->paginate(10);

        return view('index', compact('materials'));
    }
}
