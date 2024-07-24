<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\admin\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function service($slug)
    {
        $service = Service::where('slug',$slug)->first();
       // dd($service);
        return view('front.service',compact('service'));
    }
}
