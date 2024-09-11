<?php

namespace App\Livewire;

use App\Models\Service;
use Livewire\Component;

class ServiceComponent extends Component
{
    public function render()
    {
        $services = Service::orderBy('title', 'ASC')->paginate(6);
        return view('livewire.service-component',compact('services'));
    }
}
