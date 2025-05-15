<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class Button extends Component
{
    public string $type;
    public string $variant;
    public bool $full;

    public function __construct(string $type = 'submit', string $variant = 'primary', bool $full = false)
    {
        $this->type = $type;
        $this->variant = $variant;
        $this->full = $full;
    }

    public function render()
    {
        return view('components.form.button');
    }
}
