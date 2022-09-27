<?php

declare(strict_types=1);

namespace App\Http\Controllers\Author;

use App\Models\User;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function __invoke(string $author): View
    {
        $author = User::with('materials', 'materials.category')->where('email', $author)->first();
        $materials = $author->materials()->paginate(10);

        return view('author', compact('author', 'materials'));
    }
}
