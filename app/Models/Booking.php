<?php

namespace App\Models;

use Filament\Forms\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'bookings';
}
