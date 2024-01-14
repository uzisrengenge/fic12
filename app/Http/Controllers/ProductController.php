<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    //index
    public function index(request $request)
    {
       if($request->has('search')){
           $products = \App\Models\Product::where('name', 'LIKE', '%' . $request->search . '%')->paginate(8);
         }else{
              $products = \App\Models\Product::paginate(8);
            }





        // $products = \App\Models\Product::paginate(8);
        return view('pages.product.index', compact('products'));


    }

    //create
    public function create()
    {
        $categories = \App\Models\Category::all();
        return view('pages.product.create', compact('categories'));
    }

    //store
    public function store(Request $request)
    {
        $filename = time() . '.' . $request->image->extension();
        $request->image->storeAs('public/products', $filename);
        $data = $request->all();

        $product = new \App\Models\Product;
        $product->name = $request->name;
        $product->price = (int) $request->price;
        $product->stock = (int) $request->stock;
        $product->category_id = $request->category_id;
        $product->image = $filename;
        $product->descriptions = $request->descriptions;
        $product->save();



        // $product->save();

        return redirect()->route('product.index');
    }



    //show
    public function show($id)
    {
        //
    }

    //edit

    public function edit($id)
    {
        $product = \App\Models\Product::findOrFail($id);
        $categories = \App\Models\Category::all();
        return view('pages.product.edit', compact('product', 'categories'));
    }

    //update

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $item = \App\Models\Product::findOrFail($id);
        $item->name = $request->name;
        $item->price = (int) $request->price;
        $item->stock = (int) $request->stock;
        $item->category_id = $request->category_id;

        if ($request->hasFile('image')) {
            // If a new image is uploaded
            $filename = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/products', $filename);
            $item->image = $filename;
        }

        $item->descriptions = $request->descriptions;
        $item->update();
        return redirect()->route('product.index');
    }


    //destroy

    public function destroy($id)
    {
        $item = \App\Models\Product::findOrFail($id);
        $item->delete();
        return redirect()->route('product.index');
    }



}
