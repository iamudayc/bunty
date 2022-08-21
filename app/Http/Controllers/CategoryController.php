<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Category;

class CategoryController extends Controller

{

    /**

     * Show the application dashboard.

     *

     * @return \Illuminate\Http\Response

     */

    public function manageCategory()

    {
        $categories = Category::where('parent_id', '=', 0)->get();

        $allCategories = Category::pluck('title','id')->all();

        $page['heading']="career";
        $page['title']="Career";
        $arr=[];
        return view('categoryTreeview',compact('categories','allCategories','page'));

    }


    /**

     * Show the application dashboard.

     *

     * @return \Illuminate\Http\Response

     */

    public function addCategory(Request $request)

    {
        dd("P");
        $this->validate($request, [

        		'title' => 'required',

        	]);

        $input = $request->all();

        $input['parent_id'] = empty($input['parent_id']) ? 0 : $input['parent_id'];

        

        Category::create($input);

        return back()->with('success', 'New Category added successfully.');

    }


}