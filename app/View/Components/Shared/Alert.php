<?php

namespace App\View\Components\Shared;

use Illuminate\View\Component;
use Illuminate\View\View;

class Alert extends Component
{
    public function render(): View
    {
        return view('components.shared.alert');
    }
}
