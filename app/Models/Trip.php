<?php

namespace App\Models;

use App\Models\City;
use App\Models\Trip;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Trip extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    protected $casts = [
        'img_gallery' => 'array',
        // 'details' => 'array',
        // 'packageprice' => 'array',
        'description' => 'array',
    ];
}
