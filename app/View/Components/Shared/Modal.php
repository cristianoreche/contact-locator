<?php

namespace App\View\Components\Shared;

use Illuminate\View\Component;
use Illuminate\View\View;

class Modal extends Component
{
    public string $id;
    public string $title;
    public string $action;
    public string $method;

    public function __construct(
        string $id,
        string $action,
        string $title = 'Confirmação',
        string $method = 'DELETE',
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->action = $action;
        $this->method = strtoupper($method);
    }

    public function render(): View
    {
        return view('components.shared.modal');
    }
}
