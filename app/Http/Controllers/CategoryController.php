<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * @api {get} /categories Get all categories
     * @apiName GetCategories
     * @apiGroup Category
     *
     * @apiSuccess {Object[]} categories List of categories.
     */
    public function index(){
        $categories = Category::all();
        return response()->json(['categories' => $categories]);
    }

    /**
     * @api {post} /categories Create a new category
     * @apiName CreateCategory
     * @apiGroup Category
     *
     * @apiBody {String} name Name of the category.
     *
     * @apiSuccess {Object} categories The created category object.
     */
    public function store(Request $request){
        $category = Category::create($request->all()); 
        return response()->json(['categories' => $category]); 
    }

    /**
     * @api {put} /categories/:id Update a category
     * @apiName UpdateCategory
     * @apiGroup Category
     *
     * @apiParam {Number} id Category ID.
     * @apiBody {String} [name] Name of the category.
     *
     * @apiSuccess {Object} categories The updated category object.
     */
    public function update(Request $request, $id){
        $category = Category::findOrFail($id);
        $category->update($request->all());

        return response()->json(['categories'=> $category]);
    }

    /**
     * @api {delete} /categories/:id Delete a category
     * @apiName DeleteCategory
     * @apiGroup Category
     *
     * @apiParam {Number} id Category ID.
     *
     * @apiSuccess {String} message Success message.
     */
    public function destroy($id){
        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json(['message'=> 'Category deleted successfully']);
    }
}
