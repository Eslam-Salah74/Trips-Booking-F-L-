<?php

namespace App\Livewire;

use App\Models\Trip;
use Livewire\Component;
use App\Models\Category;

class TripComponent extends Component
{
    public $selectedCategory = null;

    public function render()
    {
        // تصفية الرحلات بناءً على الفئة المحددة
        $tripsQuery = Trip::orderBy('tripname', 'ASC');
        if ($this->selectedCategory) {
            $tripsQuery->where('category_id', $this->selectedCategory);
        }
        $trips = $tripsQuery->paginate(4);
        $categories = Category::with('children')->whereNull('parent_id')->get();
        //اخر الرحلات
        $lastThreeTrips = Trip::orderBy('created_at', 'desc')
                              ->take(3)
                              ->get();
                              
        return view('livewire.trip-component', [
            'trips' => $trips,
            'lastThreeTrips' => $lastThreeTrips,
            'categories' => $categories,
        ]);
    }

    public function filterByCategory($categoryId)
    {
        $this->selectedCategory = $categoryId;
    }
}
