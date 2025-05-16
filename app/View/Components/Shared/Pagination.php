<?php

namespace App\View\Components\Shared;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\View\Component;
use Illuminate\View\View;

class Pagination extends Component
{
    public $paginator;

    public function __construct(Paginator $paginator)
    {
        $this->paginator = $paginator;
    }

    public function render(): View
    {
        return view('components.shared.pagination');
    }
}