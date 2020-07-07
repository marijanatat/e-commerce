<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->category){
            $products=Product::with('categories')->whereHas('categories',function($query){
               $query->where('slug',request()->category);
            });
            $categories=Category::all();
            $categoryName=optional($categories->where('slug',request()->category)->first())->name;
        }else{
            $products=Product::where('featured',true);
           
            $categories=Category::all();
            $categoryName='Featured';
        }
      
        if(request()->sort==='low_high') {
            $products=$products->orderBy('price')->paginate(9);

        } elseif(request()->sort==='high_low') {
            $products=$products->orderBy('price','dec')->paginate(9);
        }else{
            $products=$products->paginate(9);
        }

        return view('shop', [
            'products'=>$products,
             'categories'=>$categories,
             'categoryName'=>$categoryName
            ]);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $slug)
    {
        $product=Product::where('slug',$slug)->firstOrFail();
        $mightAlsoLike=Product::where('slug','!=',$slug)->mightAlsoLike()->get();
        
// postavljena vrednost stock_threshold u voyageru na 5
        if($product->quantity>setting('site.stock_threshold')){
            $stock='<span class="badge badge-success">In stock</div>';
        }else if($product->quantity<=setting('site.stock_threshold') && $product->quantity>0){
            $stock='<div class="badge badge-warning">Low stock</div>';
        }else {
            $stock='<div class="badge badge-danger">Not available</div>';
        }
        
        return view('product',compact('product','mightAlsoLike','stock'));
    }

    // public function show( Product $product)
    // {
    //    // $product=Product::where('slug',$slug)->firstOrFail();
    //     return view('product',compact('product'));
    // }

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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function search(Request $request)
    {
        $request->validate([
            'query'=>'required|min:3'
        ]);
        $query=$request->input('query');
      //  $products=Product::where('name','like',"%$query%")->get();
        //ukoliko zelimo paginaciju umesto get ide paginate


         $products=Product::where('name','like',"%$query%")
                         ->orwhere('description','like',"%$query%")
                         ->orwhere('details','like',"%$query%")  
                      ->paginate(10);

        //uz paket use Nicolaslopezj\Searchable\SearchableTrait;
       // $products=Product::search($query)->paginate(10);
        return view('search-results ')->with('products',$products);
    }
}
