<?php

namespace App\View\Components\Shared;

use Illuminate\View\Component;

class Table extends Component
{
    public array $columns;
    public $items;
    public bool $actions;

    public function __construct(
        array $columns,
              $items,
        bool $actions = false
    ) {
        $this->columns = $columns;
        $this->items = $items;
        $this->actions = $actions;
    }

    public function render()
    {
        return view('components.shared.table');
    }
}