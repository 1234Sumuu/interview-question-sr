<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantPrice;
use App\Models\Variant;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        return view('products.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $variants = Variant::all();
        return view('products.create', compact('variants'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'sku'=>'required',
            'description'=>'required',
            'image'=>'image|mimes:png,jpg,jpeg|max:10000'
         ]);

         $product = new Product();

         $product ->name = $request->input('name');
         $product ->sku = $request->input('sku');
         $product ->description = $request->input('description');
         $product ->image=$request->input('image');

         if($request->hasFile('image')) {
             $file = Input::file('image');
             //getting timestamp
             $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());

             $name = $timestamp. '-' .$file->getClientOriginalName();

             $product->image = $name;

             $file->move(public_path().'/images/', $name);
         }

         $product ->save();
         $product->varient()->sync($request->varient, false);
         Session::flash('flash_message', 'Service successfully added!');
         return redirect()->back()->with('success', 'Service Successfully Added');

    }


    /**
     * Display the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show($product)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $variants = Variant::all();
        return view('products.edit', compact('id'));

        $product ->name = $request->input('name');
        $product ->sku = $request->input('sku');
        $product ->description = $request->input('description');
        $product ->image=$request->input('image');

        if($request->has('image')) {
            $image = $request->file('image');
            $filename = $image->getClientOriginalName();
            $image->move(public_path('images/products'), $filename);
            $product->image = $request->file('image')->getClientOriginalName();
        }

        $product->update();

        $product->categories()->sync($request->category);

        return redirect()->route('products.index');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}