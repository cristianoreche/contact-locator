<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class Button extends Component
{
    public string $type;
    public string $variant;
    public bool $full;
    public bool $disabled;
    public bool $loading;
    public ?string $loadingText;

    public function __construct(
        string $type = 'submit',
        string $variant = 'primary',
        bool $full = false,
        bool $disabled = false,
        bool $loading = false,
        string $loadingText = null
    ) {
        $this->type = $type;
        $this->variant = $variant;
        $this->full = $full;
        $this->disabled = $disabled;
        $this->loading = $loading;
        $this->loadingText = $loadingText;
    }

    public function render()
    {
        return view('components.form.button');
    }
}
