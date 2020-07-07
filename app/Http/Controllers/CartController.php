<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Validator;



class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          
        $mightAlsoLike=Product::mightAlsoLike()->get();
        return view('cart',[
            'mightAlsoLike'=>$mightAlsoLike]);
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

        $duplicates=Cart::search(function ($cartItem, $rowId) use ($request) {
            return $cartItem->id === $request->id;
        });
        if($duplicates->isNotEmpty()){
            return redirect(route('cart.index'))->with('success_message','Item is already in your Cart.');
        }
        Cart::add($request->id, $request->name, 1, $request->price)
            ->associate('App\Product');

            return redirect(route('cart.index'))->with('success_message','Item is added to your cart');
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
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|numeric|between:1,10'
        ]);

        if ($validator->fails()) {
            session()->flash('errors', collect(['Quantity must be between 1 and 10.']));
            return response()->json(['success' => false], 400);
        }

        if ($request->quantity > $request->productQuantity) {
            session()->flash('errors', collect(['We currently do not have enough items in stock.']));
            return response()->json(['success' => false], 400);
        }


        Cart::update($id,$request->quantity);
        session()->flash('success_message', 'Quantity was updated successfully!');
        return response()->json(['success'=>true]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::remove($id);
        return back()->with('success_message','Item has been removed from Cart');
    }
}
