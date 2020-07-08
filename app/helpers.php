<?php

use Carbon\Carbon;

function presentPrice($price)
    {
        return number_format( $price).' DIN';
    }

    function productImage($path)
    {
        return $path && file_exists('storage/'.$path) ? asset('storage/'.$path) : asset('img/not-found.jpg');
    }

    function presentDate($date)
{
    return Carbon::parse($date)->format('M d, Y');
}

function getNumbers()
{
    $tax = number_format((float) config('cart.tax') / 100);
        // $tax = floatval(implode(explode(',',$tax1))); 
        //$newsubTotal= number_format((float)Cart::subtotal(), 2);
        $newsubTotal = Cart::subtotal(2, '.', '');
        $newTax = $newsubTotal * $tax;
        $newTotal = $newsubTotal * (1 + $tax);

        return collect([
            'tax' => $tax,
            'newSubtotal' => $newsubTotal,
            'newTotal' => $newTotal,
            'newTax' => $newTax,
        ]);
}
    