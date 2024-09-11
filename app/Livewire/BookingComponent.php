<?php

namespace App\Livewire;

use App\Models\Trip;
use App\Models\Booking;
use Livewire\Component;

class BookingComponent extends Component
{
    
    public $name;
    public $email;
    public $phone1;
    public $phone2;
    public $address;

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email',
        'phone1' => 'required|min:11|max:12',
        'phone2' => 'required|min:11|max:12',
        'address' => 'required', // removed email validation, as it is address
    ];

    public $trip;

    public function mount($id)
    {
        $this->trip = Trip::findOrFail($id);
        // Initialize trip-related fields
        // $this->trip_name = $this->trip->name; // assuming these fields exist
        // $this->trip_price = $this->trip->price;
        // $this->trip_location = $this->trip->city->name;
        // $this->trip_subdescription = $this->trip->subdescription;
    }

    public function submit()
    {
        $this->validate();
        
        try {
            
            // Create a new booking record in the database
            Booking::create([
                'trip_id' => $this->trip->id, // Assuming a trip_id column exists in Booking table
                'name' => $this->name,
                'email' => $this->email,
                'phone1' => $this->phone1,
                'phone2' => $this->phone2,
                'address' => $this->address,
            ]);
          

            session()->flash('success', 'Booking submitted successfully.');
            $this->reset(['name', 'email', 'phone1', 'phone2', 'address']); // Reset only specific fields

            return redirect()->route('trips'); // Use route name instead of URL
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to submit booking. Please try again later.');
        }
    }

    public function render()
    {
        return view('livewire.booking-component');
    }
}

