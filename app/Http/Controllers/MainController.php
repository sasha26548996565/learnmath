<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class MainController extends Controller
{
    public function index(): View
    {
        $materials = Material::with('category')->latest()->paginate(10);
        return view('index', compact('materials'));
    }
}
