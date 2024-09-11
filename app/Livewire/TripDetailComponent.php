<?php

namespace App\Livewire;

use App\Models\Trip;
use Livewire\Component;

class TripDetailComponent extends Component
{
    public $trip;

    public function mount($id)
    {
        $this->trip = Trip::findOrFail($id);
    } 

    public function render()
    {
        return view('livewire.trip-detail-component');
    }
}
