<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class SearchController extends Controller
{
    public function search(Request $request): View
    {
        $materials = Material::with('category')->where('name', 'LIKE', '%'. $request->search .'%')->latest()->paginate(10);

        return view('search', compact('materials'));
    }
}
