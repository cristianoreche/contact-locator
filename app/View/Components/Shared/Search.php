<?php

namespace App\View\Components\Shared;

use Illuminate\View\Component;

class Search extends Component
{
    public $name;
    public $placeholder;
    public $value;
    public $class;
    public $id;

    public function __construct($name, $placeholder = null, $value = null, $class = null, $id = null)
    {
        $this->name = $name;
        $this->placeholder = $placeholder;
        $this->value = $value;
        $this->class = $class;
        $this->id = $id;
    }

    public function render()
    {
        return view('components.shared.search');
    }
}
