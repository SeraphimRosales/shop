<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
    $user = Auth::user();
    $admin = false;
   
    $products = Product::all();
   
    if ($user != null) {
    if ($user->isAdmin) {
    $admin = true;
    $products = Product::where('user_id', '=', $user->id)->get();
    }
    }
   
    return view('shop', ['products' => $products, 'admin' => $admin]);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
{
return view('addProduct');
}


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{

$filename = $request->img->getClientOriginalName();

$request->img->move(public_path('img'), $filename);
$product = Product::create([
'product_name' => $request['product_name'],
'price' => $request['product_price'],
'img' => $filename,
'user_id' => Auth::id()
]);
return redirect('shop');
}


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    $product = Product::find($id);
    return view('editProduct', ['product' => $product]);
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
{
$product = Product::find($id);
if ($request->hasFile('img')) {
$filename = $request->photo->getClientOriginalName();
$request->img->move(public_path('img'), $filename);
} else {
$filename = $product->img;
}
$product->product_name = $request->product_name;
$product->price = $request->product_price;
$product->img = $filename;
$product->save();
return redirect("shop");
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    $product = Product::find($id);
    $product->delete();
    return redirect("shop");
    }
}
