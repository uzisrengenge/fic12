<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;


class CategoryController extends Controller
{
    //index
    public function index(Request $request )
    {


      $categories = DB::table('categories')
        ->when($request->search, function ($query) use ($request) {
             return $query->where('name', 'like', "%{$request->search}%")
                        ->orWhere('descriptions', 'like', "%{$request->search}%");
        })
        ->paginate(5);

        return view('pages.category.index', compact('categories') );

    }

    //create
    public function create()
    {
        return view('pages.category.create');
    }

    //store
    public function store(Request $request)
    {
        $filename = time() . '.' . $request->image->extension();
        $request->image->storeAs('public/category', $filename);
        // $data = $request->all();

        $category = new \App\Models\Category;
        $category->name = $request->name;
        $category->descriptions = $request->descriptions;
        $category->image = $filename;
        $category->save();

        return redirect()->route('category.index');


    }

    //show
    public function show($id)
    {
        //
    }

    //edit
    public function edit($id)
    {

        $category = \App\Models\Category::findOrFail($id);
        return view('pages.category.edit', compact('category'));

    }

    //update
    public function update(Request $request, $id)
    {
        $data = $request->all();

        $category = \App\Models\Category::findOrFail($id);
        $category->name = $request->name;
        $category->descriptions = $request->descriptions;

        if ($request->hasFile('image')) {
            $filename = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/category', $filename);
            $category->image = $filename;
        }

        $category->save(); // Use save() instead of update() for updating an existing model
        return redirect()->route('category.index');
    }


    //destroy
    public function destroy($id)
    {
        $item = \App\Models\Category::findOrFail($id);
        $item->delete();
        return redirect()->route('category.index');
    }

}
