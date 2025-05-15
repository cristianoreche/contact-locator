<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;
use Illuminate\View\View;

class Form extends Component
{
    public function __construct(
        public ?string $method = 'POST',
        public ?string $action = '',
        public ?string $class = ''
    ) {}

    public function render(): View
    {
        return view('components.form.form');
    }
}
