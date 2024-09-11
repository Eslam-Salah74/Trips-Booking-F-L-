<?php

use App\Models\Service;
     
     
     
    function getServices(){
        $services = Service::orderBy('title','ASC')->limit(4)->get();
        return $services;
    }
?>