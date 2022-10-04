<?php

declare(strict_types=1);

namespace App\ViewComposers;

use Illuminate\View\View;

interface ViewComposerContract
{
    public function compose(View $view): View;
}
