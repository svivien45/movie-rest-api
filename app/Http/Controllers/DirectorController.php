<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Director;
use Illuminate\Http\Request;

class DirectorController extends Controller
{
    /**
     * @api {get} /directors Get all directors
     * @apiName GetDirectors
     * @apiGroup Director
     * 
     * @apiSuccess {Object[]} directors List of directors.
     */
    public function index(){
        $directors = Director::all();
        return response()->json(['directors' => $directors]);
    }

    /**
     * @api {post} /directors Create a new director
     * @apiName CreateDirector
     * @apiGroup Director
     * 
     * @apiBody {String} name Name of the director.
     * @apiBody {String} [birth_date] Birth date (optional).
     * @apiBody {String} [bio] Short biography (optional).
     * 
     * @apiSuccess {Object} director The created director object.
     */
    public function store(Request $request){
        $director = Director::create($request->all());
        return response()->json(['director'=> $director]);
    }

    /**
     * @api {put} /directors/:id Update a director
     * @apiName UpdateDirector
     * @apiGroup Director
     * 
     * @apiParam {Number} id Director ID.
     * @apiBody {String} [name] Name of the director.
     * @apiBody {String} [birth_date] Birth date.
     * @apiBody {String} [bio] Biography.
     * 
     * @apiSuccess {Object} director The updated director object.
     */
    public function update(Request $request, $id){
        $director = Director::findOrFail($id);
        $director->update($request->all());

        return response()->json(['director'=> $director]);
    }

    /**
     * @api {delete} /directors/:id Delete a director
     * @apiName DeleteDirector
     * @apiGroup Director
     * 
     * @apiParam {Number} id Director ID.
     * 
     * @apiSuccess {String} message Success message.
     */
    public function destroy($id){
        $director = Director::findOrFail($id);
        $director->delete();

        return response()->json(['message'=> 'Director deleted successfully']);
    }
}
