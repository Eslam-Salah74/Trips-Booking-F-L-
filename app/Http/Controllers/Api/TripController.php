<?php

namespace App\Http\Controllers\Api;

use App\Models\Trip;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\ApiResponceTrait;

class TripController extends Controller
{
    use ApiResponceTrait; 
    public function index()
    {

        $trips = Trip::get();
        return $this->apiResponse($trips,'تم جلب البيانات بنجاح',200);
    }
}
