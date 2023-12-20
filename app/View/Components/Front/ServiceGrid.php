<?php

namespace App\View\Components\Front;

use Illuminate\View\Component;
use Illuminate\View\View;
use App\Models\Service;

class ServiceGrid extends Component
{

    public function __construct()
    {
    }

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('components.front.service-grid', [
            "services" => Service::all()
        ]);
    }
}
