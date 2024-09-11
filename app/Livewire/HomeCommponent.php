<?php

namespace App\Livewire;

use App\Models\Trip;
use App\Models\Service;
use Livewire\Component;

class HomeCommponent extends Component
{
    public function render()
{
    $services = Service::orderBy('title', 'ASC')->paginate(5);
    $trips = Trip::orderBy('tripname', 'ASC')->paginate(6);
    return view('livewire.home-commponent', ['services'=>$services,'trips'=>$trips]);
}

}
