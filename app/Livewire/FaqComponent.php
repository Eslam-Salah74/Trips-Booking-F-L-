<?php

namespace App\Livewire;

use App\Models\Faq;
use Livewire\Component;

class FaqComponent extends Component
{
    public function render()
    {
        $faqs = Faq::orderBy('question', 'ASC')->paginate(6);
        return view('livewire.faq-component',['faqs'=>$faqs]);
    }
}
