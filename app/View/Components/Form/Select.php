<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;
use Illuminate\View\View;

class Select extends Component
{
    public string $name;
    public ?string $label;
    public array $options;
    public ?string $placeholder;
    public bool $required;

    public function __construct(
        string $name,
        ?string $label = null,
        array $options = [],
        ?string $placeholder = 'Selecione...',
        bool $required = false
    ) {
        $this->name = $name;
        $this->label = $label;
        $this->options = $options;
        $this->placeholder = $placeholder;
        $this->required = $required;
    }

    public function render(): View
    {
        return view('components.form.select');
    }
}
