<?php

namespace App\View\Components\Shared;

use Illuminate\View\Component;
use Illuminate\View\View;

class Map extends Component
{
    public float $lat;
    public float $lng;
    public string $id;
    public int $zoom;

    public function __construct(?float $lat, ?float $lng, string $id = 'main', int $zoom = 13)
    {
        $this->lat = $lat ?? 0;
        $this->lng = $lng ?? 0;
        $this->id = $id;
        $this->zoom = $zoom;
    }

    public function render(): View
    {
        return view('components.shared.map');
    }
}
