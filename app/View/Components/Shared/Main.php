<?php

namespace App\View\Components\Shared;

use Illuminate\View\Component;
use Illuminate\View\View;

class Main extends Component
{
    public function render(): View
    {
        return view('components.shared.main');
    }
}
