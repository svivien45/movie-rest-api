<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Movie;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::all();
        return response()->json(['movies' => $movies]);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|min:2',
            'categories_id' => 'required|numeric',
            'description' => 'required|string|min:10',
            'pic_path' => 'required|string|min:10',
            'length' => 'required|string|min:2',
            'release_date' => 'required|string|min:4',
            'director_id' => 'required|numeric'
        ]);
        $movie = Movie::create($request->all());
        return response()->json(['movie' => $movie]);
    }
}
