<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\CheckoutRequest;
use App\Mail\OrderPlaced;
use App\Order;
use App\OrderProduct;
use Gloudemans\Shoppingcart\Facades\Cart;


class CheckoutController extends Controller
{
    
    public function index()
    {
         if (Cart::instance('default')->count() == 0) {
            return redirect()->route('shop.index');
        }
        if (auth()->user() && request()->is('guestCheckout')) {
                return redirect()->route('checkout.index');
        }
     
        // return view('checkout')->with([         
      
        //     'newSubtotal' => $this->getNumbers()->get('newSubtotal'),
        //     'newTax' => $this->getNumbers()->get('newTax'),
        //     'newTotal' => getNumbers()->get('newTotal'),
        // ]);  
        return view('checkout');
     }

   
    public function create()
    {
        //
    }

   
    public function store(CheckoutRequest $request)
    {

        if($this->productsAreNoLongerAvailable()){
            return back()->withErrors('Item is no longer available');
        }
        $contents = Cart::content()->map(function ($item) {
            return $item->model->slug.', '.$item->qty;
             })->values()->toJson();
        $order=$this->addToOrdersTable($request,null);
        Mail::send(new OrderPlaced($order));
        //Mail::to($request->email)->send(new OrderPlaced);
        $this->decreaseQuantities();
        //Cart::instance('default')->destroy();
        return redirect()->route('confirmation.index')->with('success_message', 'Thank you! Your payment has been successfully accepted!');

       
    }
    protected function productsAreNoLongerAvailable()
    {
        foreach (Cart::content() as $item) {
            $product = Product::find($item->model->id);
            if ($product->quantity < $item->qty) {
                return true;
            }
        }

        return false;
    }

    protected function addToOrdersTable($request,$error){

        $order=Order::create([
               'user_id'=>auth()->user()? auth()->user()->id : null,
               'billing_email' => $request->email,
               'billing_name' => $request->name,
               'billing_address' => $request->address,
               'billing_city' => $request->city,
               'billing_province' => $request->province,
               'billing_postalcode' => $request->postalcode,
               'billing_phone' => $request->phone,
               'billing_name_on_card' => $request->name_on_card,
                'billing_subtotal' =>$this->getNumbers()->get('newSubtotal'),
                'billing_tax' => $this->getNumbers()->get('newTax'),
                'billing_total'=>$this->getNumbers()->get('newTotal'),
               'error' => $error,
            ]);
    
            foreach (Cart::content() as $item) {
                OrderProduct::create([
                    'order_id'=>$order->id,
                    'product_id'=>$item->model->id,
                    'quantity'=>$item->qty
                ]);
            }
            return $order;

    }

    protected function decreaseQuantities(){
        foreach(Cart::content() as $item){
            $product=Product::find($item->model->id);
            $product->update(['quantity'=>$product->quantity-$item->qty]);
        }
    }

    private function getNumbers()
    {
        $tax=number_format((float)config('cart.tax')/100);  
        // $tax = floatval(implode(explode(',',$tax1))); 
        //$newsubTotal= number_format((float)Cart::subtotal(), 2);
         $newsubTotal=Cart::subtotal(2,'.','');
        $newTax=$newsubTotal * $tax;
        $newTotal=$newsubTotal * (1 + $tax);

        return collect([
            'tax'=>$tax,
            'newSubtotal'=>$newsubTotal,
            'newTotal'=>$newTotal,
            'newTax'=>$newTax,
        ]);
    }

  

    public function show($id)
    {
        //
    }

   
    public function edit($id)
    {
        //
    }

   
    public function update(Request $request, $id)
    {
        //
    }

   
    public function destroy($id)
    {
        //
    }
}
