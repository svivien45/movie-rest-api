<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Actor;

class ActorController extends Controller
{
    /**
     * @api {get} /actors Get all actors
     * @apiName GetActors
     * @apiGroup Actor
     * 
     * @apiSuccess {Object[]} actors List of all actors.
     */
    public function index(Request $request){
        $movie_id = $request->get("movie");
        $actors = Actor::where("movie_id", "=", $movie_id)->orderBy("name")->get();
        return response()->json(['actors' => $actors]); 
    }

    /**
     * @api {post} /actors Create a new actor
     * @apiName CreateActor
     * @apiGroup Actor
     * 
     * @apiBody {String} name Name of the actor.
     * @apiBody {String} birth_date Birth date of the actor.
     * @apiBody {String} [bio] Short biography (optional).
     * 
     * @apiSuccess {Object} actor The created actor object.
     */
    public function store(Request $request){
        $actor = Actor::create($request->all());
        return response()->json(['actor'=> $actor]);
    }

    /**
     * @api {put} /actors/:id Update an actor
     * @apiName UpdateActor
     * @apiGroup Actor
     * 
     * @apiParam {Number} id Actor ID.
     * @apiBody {String} [name] Name of the actor.
     * @apiBody {String} [birth_date] Birth date.
     * @apiBody {String} [bio] Biography.
     * 
     * @apiSuccess {Object} actor The updated actor object.
     */
    public function update(Request $request, $id){
        $actor = Actor::findOrFail($id);
        $actor->update($request->all());

        return response()->json(['actor'=> $actor]);
    }

    /**
     * @api {delete} /actors/:id Delete an actor
     * @apiName DeleteActor
     * @apiGroup Actor
     * 
     * @apiParam {Number} id Actor ID.
     * 
     * @apiSuccess {String} message Deletion confirmation.
     * @apiSuccess {Number} id ID of the deleted actor.
     */
    public function destroy($id){
        $actor = Actor::findOrFail($id);
        $actor->delete();

        return response()->json([
            'message'=> 'Actor deleted successfully',
            'id' => $id
        ]);
    }
}
