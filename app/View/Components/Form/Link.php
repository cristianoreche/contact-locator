<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class Link extends Component
{
    public string $href;
    public string $variant;

    public function __construct(string $href, string $variant = 'link')
    {
        $this->href = $href;
        $this->variant = $variant;
    }

    public function render()
    {
        return view('components.form.link');
    }
}

