<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;

use Illuminate\View\Component;

class DashboardCard extends Component
{
    public $title;
    public $value;
    public $icon;
    public $color;

    public function __construct($title, $value = 0, $icon = '', $color = 'blue')
    {
        $this->title = $title;
        $this->value = $value;
        $this->icon = $icon;
        $this->color = $color;
    }

    public function render()
    {
        return view('components.dashboard-card');
    }
}