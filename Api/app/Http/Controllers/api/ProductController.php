<?php

namespace App\Http\Controllers\api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('category')->get();
        return response()->json($products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {   
        $validated = $request->validated();
        //creating a name for the image and store it in /public/images folder
        $newImageName = time().'-'.$request->title.'.'.$request->image->extension();
        $request->image->move(public_path('images'),$newImageName);

        $product = new Product;

        $product->title = $request->title;
        $product->ref = $request->ref;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->category_id = $request->category_id;
        $product->image_path = $newImageName;
        $product->save();

        return response()->json(['message'=>'product created'],200); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::where('id',$id)->with('category')->first();
        return response()->json($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
    //add promotion to product
    public function promotion(Request $request,Product $product)
    {
        $product->promotion = $request->input('promo');
        $product->save();
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        $product = Product::find($id);
        $product->title = $request->title;
        $product->ref = $request->ref;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->category_id = $request->category_id;
        
        if($request->image){
            return response()->json("test");
            $newImageName = time().'-'.$request->title.'.'.$request->image->extension();
            $request->image->move(public_path('images'),$newImageName);
            $product->image_path = $newImageName;

        }
        return response()->json($request);
        $product->save();
        

        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {   
        $destination = 'images/'.$product->image_path;
        if(File::exists($destination)){
            File::delete($destination);
        }
        $product->delete();
        return response()->json(['message'=>'product deleted'],200);
    }
}
