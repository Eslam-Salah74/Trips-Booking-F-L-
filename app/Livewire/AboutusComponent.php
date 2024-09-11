<?php

namespace App\Livewire;

use App\Models\Member;
use App\Models\aboutus;
use Livewire\Component;

class AboutusComponent extends Component
{
    public function render()
    {
        $aboutus = aboutus::get();
        $members = Member::inRandomOrder()->limit(4)->get();
        return view('livewire.aboutus-component',['aboutus'=>$aboutus,'members'=>$members]);
    }
}
