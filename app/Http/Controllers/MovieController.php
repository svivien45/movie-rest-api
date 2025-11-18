<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Movie;

class MovieController extends Controller
{
    /**
     * @api {get} /movies Get all movies
     * @apiName GetMovies
     * @apiGroup Movie
     * @apiSuccess {Object[]} movies List of movies.
     */
    public function index(Request $request)
    {

        $movies = Movie::all();
        return response()->json(['movies' => $movies]);
    }

    public function indexStudio(Movie $movie)
    {
        return response()->json($movie->studio);
    }


    /**
     * @api {post} /movies Create a new movie
     * @apiName CreateMovie
     * @apiGroup Movie
     * 
     * @apiBody {String} name Movie name.
     * @apiBody {Number} categories_id ID of the category.
     * @apiBody {String} description Description of the movie.
     * @apiBody {String} pic_path Path to movie picture.
     * @apiBody {String} length Duration of the movie.
     * @apiBody {String} release_date Release date of the movie.
     * 
     * @apiSuccess {Object} movie Created movie object.
     */ 
    public function store(Request $request){
        $movie = Movie::create(  $request->all());
        return response()->json(['movie' => $movie]);
    }

    /**
     * @api {put} /movies/:id Update a movie
     * @apiName UpdateMovie
     * @apiGroup Movie
     * 
     * @apiParam {Number} id Movie ID.
     * @apiBody {String} [name] Movie name.
     * @apiBody {Number} [categories_id] Category ID.
     * @apiBody {String} [description] Description.
     * @apiBody {String} [pic_path] Picture path.
     * @apiBody {String} [length] Length.
     * @apiBody {String} [release_date] Release date.
     * 
     * @apiSuccess {Object} movie Updated movie object.
     */
    public function update(Request $request, $id){
        $movie = Movie::findOrFail($id);
        $movie->update($request->all());

        return response()->json(['movie' => $movie]);
    }

    /**
     * @api {delete} /movies/:id Delete a movie
     * @apiName DeleteMovie
     * @apiGroup Movie
     * 
     * @apiParam {Number} id Movie ID.
     * 
     * @apiSuccess {String} message Success message.
     * @apiSuccess {Number} id Deleted movie ID.
     */
    public function destroy($id){
        $movie = Movie::findOrFail($id);
        $movie->delete();

        return response()->json([
            'message'=> 'Movie deleted successfully',
            'id' => $id
        ]);
    }

    public function addActor(Request $request, Movie $movie)
    {
        $request->validate([
            'actor_id' => 'required|exists:actors,id'
        ]);

        // Pivot táblába mentés
        $movie->actors()->attach($request->actor_id);

        return response()->json([
            'message' => 'Actor added to movie successfully.',
            'movie' => $movie->load('actors')
        ]);
    }

}
