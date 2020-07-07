<?php

 function presentPrice($price)
    {
        return number_format( $price).' DIN';
    }

    function productImage($path)
    {
        return $path && file_exists('storage/'.$path) ? asset('storage/'.$path) : asset('img/not-found.jpg');
    }

    