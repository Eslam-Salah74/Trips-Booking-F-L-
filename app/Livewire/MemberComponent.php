<?php

namespace App\Livewire;

use App\Models\Member;
use Livewire\Component;

class MemberComponent extends Component
{
    public function render()
    {
        $members = Member::orderBy('name', 'ASC')->paginate(4);
        return view('livewire.member-component',['members'=>$members]);
    }
}
