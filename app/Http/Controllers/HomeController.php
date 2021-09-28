<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cuisine;
use App\Models\Feature;
use App\Models\FoodTruck;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('welcome');
    }

    public function homepage(){
        $cuisines=Cuisine::all();
        $foodTrucks = FoodTruck::with(['cuisines', 'days'])
         ->searchResults()
        ->paginate(9);
        $maptrucks = FoodTruck::where('active','Active')->get();


        return view('welcome',compact('cuisines','foodTrucks','maptrucks'));
    }
}
