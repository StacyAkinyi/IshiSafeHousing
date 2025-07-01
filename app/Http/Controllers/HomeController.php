<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;

class HomeController extends Controller
{
     public function index()
        {
            // Fetch properties that have coordinates and at least one available room.
            // We only select the columns needed for the map to be efficient.
            $properties = Property::whereNotNull('latitude')
                ->whereNotNull('longitude')
                ->whereHas('rooms', function ($query) {
                    $query->where('is_available', true);
                })
                ->get(['id', 'name', 'latitude', 'longitude']);

            return view('welcome', ['propertiesForMap' => $properties]);
        }
}
