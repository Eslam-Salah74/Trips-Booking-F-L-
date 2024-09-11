<?php

use App\Livewire\FaqComponent;
use App\Livewire\TripComponent;
use App\Livewire\HomeCommponent;
use App\Livewire\MemberComponent;
use App\Livewire\AboutusComponent;
use App\Livewire\BookingComponent;
use App\Livewire\ContactComponent;
use App\Livewire\ServiceComponent;
use App\Livewire\TripDetailComponent;
use Illuminate\Support\Facades\Route;
use App\Livewire\ServiceDetailComponent;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',HomeCommponent::class)->name('home');

Route::get('/services',ServiceComponent::class)->name('services');
Route::get('/service/{id}',ServiceDetailComponent::class)->name('servicedetails');

Route::get('/members',MemberComponent::class)->name('members');

Route::get('/trips',TripComponent::class)->name('trips');
Route::get('/trip/{id}',TripDetailComponent::class)->name('tripdetails');

Route::get('/faqs',FaqComponent::class)->name('faqs');
Route::get('/aboutus',AboutusComponent::class)->name('aboutus');
Route::get('/contact',ContactComponent::class)->name('contact');

Route::get('/booking/{id}',BookingComponent::class)->name('booking');

