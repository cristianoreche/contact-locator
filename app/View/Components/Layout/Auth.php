<?php

namespace App\View\Components\Layout;

use Illuminate\View\Component;
use Illuminate\View\View;

class Auth extends Component
{
    public function render(): View
    {
        return view('components.layout.auth');
    }
}
