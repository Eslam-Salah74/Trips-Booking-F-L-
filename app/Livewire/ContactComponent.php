<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMessage;

class ContactComponent extends Component
{
    public $name;
    public $email;
    public $message;

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email',
        'message' => 'required|min:5',
    ];

    public function submit()
    {
        $this->validate();
    
        $mailData = [
            'subject' => 'Contact Form Submission', // Set a subject here
            'name' => $this->name,
            'email' => $this->email,
            'message' => $this->message,
        ];
    
        try {
            // Send the email using Mailable
            Mail::to('eslamsalah20003000@gmail.com') // Replace with the target email address
                ->send(new ContactMessage($mailData));
    
            // Clear fields after sending
            $this->reset(['name', 'email', 'message']);
    
            // Show success message
            session()->flash('success', 'Message sent successfully.');
            return redirect()->route('contact'); // Use route name instead of URL
        } catch (\Exception $e) {
            // Show error message if email sending fails
            session()->flash('error', 'Failed to send message. Please try again later.');
        }
    }
    

    public function render()
    {
        return view('livewire.contact-component');
    }
}
