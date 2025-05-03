<?php

namespace App\Http\Controllers;
use App\Models\Car;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index(){
        return view('welcome');
    }
    public function about(){
        return view('about');
    }

    public function cars(){
        $car = Car::paginate(10);
        return view("cars", compact("car"));
    }
}
