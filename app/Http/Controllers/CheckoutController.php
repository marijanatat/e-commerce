<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\CheckoutRequest;
use Gloudemans\Shoppingcart\Facades\Cart;


class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         if (Cart::instance('default')->count() == 0) {
            return redirect()->route('shop.index');
        }

        if (auth()->user() && request()->is('guestCheckout')) {
                return redirect()->route('checkout.index');
        }
     
        // return view('checkout')->with([         
        //     'discount' => getNumbers()->get('discount'),
        //     'newSubtotal' => getNumbers()->get('newSubtotal'),
        //     'newTax' => getNumbers()->get('newTax'),
        //     'newTotal' => getNumbers()->get('newTotal'),
        // ]);  
        return view('checkout');
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
    public function store(CheckoutRequest $request)
    {
        $contents = Cart::content()->map(function ($item) {
            return $item->model->slug.', '.$item->qty;
        })->values()->toJson();

        try {
            $charge = Stripe::charges()->create([
                'amount' => getNumbers()->get('newTotal') / 100,
                'currency' => 'CAD',
             
                'description' => 'Order',
                'receipt_email' => $request->email,
                'metadata' => [
                    'contents' => $contents,
                    'quantity' => Cart::instance('default')->count(),
                    'discount' => collect(session()->get('coupon'))->toJson(),
                ],
            ]);

        } catch (CardErrorException $e) {
            // $this->addToOrdersTables($request, $e->getMessage());
            return back()->withErrors('Error! ' . $e->getMessage());
        }
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
}
