<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Actor;
use App\Models\ConnectMoviesActors;
use App\Models\Movie;

class ConnectMoviesActorsController extends Controller
{
   
    public function index(Request $request, $movie_id) 
    {
        $actors = Movie::find($movie_id)->actors;
        return response()->json(['actors' => $actors]); 
    }

}
