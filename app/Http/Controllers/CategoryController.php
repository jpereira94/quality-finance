<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;

use App\Http\Requests;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::Parents();
        return view('settings.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('settings.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        //gets all the answered inputs
        $inputs = $request->all();
        //if the input is 0 i.e. it is not filled then unset it so that in the database this field appears as null
        if($inputs['category_id'] == 0)
            unset($inputs['category_id']);

        //add the category to the database
        Category::create($inputs);

        //return to the index view
        return redirect()->action('CategoryController@index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function edit(Category $category)
    {
        return view('settings.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryRequest $request
     * @param Category $category
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(CategoryRequest $request, Category $category)
    {
        //gets all the answered inputs
        $inputs = $request->all();
        //if the input is 0 i.e. it is not filled then unset it so that in the database this field appears as null
        if($inputs['category_id'] == 0)
            unset($inputs['category_id']);

        //update the category to the database
        $category->update($inputs);

        //return to the index view
        return redirect()->action('CategoryController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return \Illuminate\Http\Response
     * @throws \Exception
     * @internal param int $id
     */
    public function destroy(Category $category)
    {
        $category->delete();
        //return to the index view
        return redirect()->action('CategoryController@index');
    }
}
