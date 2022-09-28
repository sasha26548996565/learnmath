<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Material;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class FavouriteController extends Controller
{
    public function index(): View
    {
        $materials = Auth::user()->favouriteMaterials()->paginate(10);

        return view('favourite.index', compact('materials'));
    }

    public function toggleActive(Material $material): RedirectResponse
    {
        Auth::user()->favouriteMaterials()->toggle($material->id);

        return to_route('favourite.index');
    }
}
