<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class MaterialController extends Controller
{
    public function create(): View
    {
        $categories = Category::latest()->get();

        return view('material.create');
    }
}
