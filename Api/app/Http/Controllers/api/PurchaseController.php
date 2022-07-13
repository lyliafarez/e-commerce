<?php

namespace App\Http\Controllers\api;
use App\Models\User;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $user_id = Auth::user()->id;
        $purchases = Purchase::with(['product','user'])->where('user_id',$user_id)->where('command_status',1)->get();

        return response()->json($purchases);
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
    //get purchased items

    public function purchasedProducts(User $user){
        $user_id = Auth::user()->id;
       $purchases = Purchase::where('user_id',$user_d)->where('command_status',1)->get();
       foreach($purchases as $purchase){
           $purchase->command_status = 0;
           $purchase->save();
       }
       return response()->json([$purchases,$user]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Product $product)
    {   
        // get the stock of the product passed in the parameter
        $stock = $product->stock;
        // get the id of auth user
        $id = Auth::user()->id;

        //creating a new purchase
        $purchase = new Purchase;
        $purchase->user_id = $id ;
        $purchase->product_id = $product->id;
        $purchase->quantity = 1;
        $purchase->command_status = 1;

        $purchase->save();
        $product->save();
        
        return response()->json(['message'=>'purchase added'],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Product $product)
    {   
        
    }

    // update the quantity of the purchased product
    public function updateCount(Product $product)
    {
        //get stock of product passed as a param
        $stock = $product->stock;
        // get id of auth user
        $user_id = Auth::user()->id;

        $purchase = Purchase::where('user_id',$user_id)->where('product_id',$product->id)->where('command_status',1)->first();
        $quantity = $purchase->quantity;
        $purchase->quantity = $quantity+1;
        //managing product stock
        $product->stock = $stock -  $purchase->quantity;

        $purchase->save();
        $product->save();
        
        return response()->json($purchase);
       
    }

    //reduce the quantity of the product when removed from cart
    public function minusCount(Product $product)
    {   
        //get stock of product passed as a param
        $stock = $product->stock;
        // get id of auth user
        $user_id = Auth::user()->id;

        $purchase = Purchase::where('user_id',$user_id)->where('product_id',$product->id)->where('command_status',1)->first();
        $quantity = $purchase->quantity;
        $purchase->quantity = $quantity-1;
        //managing stock
        $product->stock = $stock + 1;

        $product->save();
        $purchase->save();
        
        return response()->json($purchase);
    }

    
    public function countProduct(Product $product){
        $user_id = Auth::user()->id;
        $products = Purchase::where('user_id',$user_id)->where('product_id',$product->id)->where('command_status',1)->get();
        $count_products = $products->count();

        return response()->json($count_products);
    }

    public function sumProductsPrice(){
        $sum=0;
        $user_id = Auth::user()->id;
        $purchases = Purchase::where('user_id',$user_id)->where('command_status',1)->with('product')->get();
        if($purchases){
            foreach($purchases as $purchase){
                $sum = $sum + ($purchase->quantity * $purchase->product->price);
            }
        }
        
        return response()->json($sum);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase,Product $product)
    {   $stock = $product->stock;
        $product->stock = $stock + $purchase->quantity;
        $product->save();
        $purchase->delete();
        return response()->json(['message' => 'purchase deleted'],200);
    }

    //delete purchase record
    public function delete()
    {
        $user_id = Auth::user()->id;
        Purchase::where('user_id',$user_id)->delete();
        return response()->json(['massage'=>'items purchased']);
    }
}
