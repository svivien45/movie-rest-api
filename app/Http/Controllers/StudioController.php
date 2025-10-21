<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Studio;
use Illuminate\Http\Request;

class StudioController extends Controller
{
    /**
     * @api {get} /studios Get all studios
     * @apiName GetStudios
     * @apiGroup Studio
     *
     * @apiSuccess {Object[]} studios List of studios.
     */
    public function index(){
        $studios = Studio::all();
        return response()->json(['studios' => $studios]);
    }

    /**
     * @api {post} /studios Create a new studio
     * @apiName CreateStudio
     * @apiGroup Studio
     *
     * @apiBody {String} name Name of the studio.
     * @apiBody {String} [location] Location of the studio (optional).
     *
     * @apiSuccess {Object} studio The created studio object.
     */
    public function store(Request $request){
        $studio = Studio::create($request->all());
        return response()->json(['studio'=> $studio]);
    }

    /**
     * @api {put} /studios/:id Update a studio
     * @apiName UpdateStudio
     * @apiGroup Studio
     *
     * @apiParam {Number} id Studio ID.
     * @apiBody {String} [name] Name of the studio.
     * @apiBody {String} [location] Location of the studio.
     *
     * @apiSuccess {Object} studio The updated studio object.
     */
    public function update(Request $request, $id){
        $studio = Studio::findOrFail($id);
        $studio->update($request->all());

        return response()->json(['studio'=> $studio]);
    }

    /**
     * @api {delete} /studios/:id Delete a studio
     * @apiName DeleteStudio
     * @apiGroup Studio
     *
     * @apiParam {Number} id Studio ID.
     *
     * @apiSuccess {String} message Success message.
     */
    public function destroy($id){
        $studio = Studio::findOrFail($id);
        $studio->delete();

        return response()->json(['message'=> 'Studio deleted successfully']);
    }
}
