 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Document</title>
 </head>
 <body>
     <p>
         This is the email
     </p>

        Order ID:** {{ $order->id }} <br>

        Order Email:** {{ $order->billing_email }} <br>

        Order Name:** {{ $order->billing_name }} <br>

        Order Total:** DIN {{ $order->billing_total }} <br>

      
     
        **Items Ordered ** <br>

        @foreach ( $order->products  as $product)
         Name: {{ $product->name }} <br>
         Price: DIN {{ $product->price }} <br>
         Quantity: {{ $product->pivot->quantity }} <br>

            
        @endforeach
     
 </body>
 </html>