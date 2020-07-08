@extends('layout')

@section('title', 'Shopping Cart')

@section('content')

@component('components.breadcrumbs')
    <a href="#">Home</a>
    <i class="fa fa-chevron-right breadcrumb-separator"></i>
    <span>Shopping Cart</span>
@endcomponent

    <div class="cart-section container">
        <div>
            @if (session()->has('success_message'))
            <div class="alert alert-success">
                {{ session()->get('success_message') }}
            </div>
        @endif

        @if(count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

         @if (Cart::count() > 0)

        <h2>{{ Cart::count() }} item(s) in Shopping Cart</h2> 
        

            <div class="cart-table">
                @foreach (Cart::content() as $item)
                <div class="cart-table-row">
                    <div class="cart-table-row-left">
                    <a href="{{route('shop.show',$item->model->slug)}}"><img src="{{asset('storage/'.$item->model->image)}}" alt="item" class="cart-table-img"></a>
                        <div class="cart-item-details">
                            <div class="cart-table-item"><a href="{{route('shop.show',$item->model->slug)}}">{{$item->model->name}}</a></div>
                            <div class="cart-table-description">{{$item->model->details}}</div>
                        </div>
                    </div>
                    <div class="cart-table-row-right">
                      
                        <div>
                            <select class="quantity" data-id="{{$item->rowId}}" data-productQuantity="{{$item->model->quantity}}" >
                                @for ($i = 1; $i < 10; $i++)                       
                                 <option {{$item->qty==$i?'selected':''}}>{{$i}}</option>   
                                @endfor                           
                        </select> 

                        </div> 
                        <div style="margin-left: 3px">{{ presentPrice($item->subtotal)}}</div>

                             <div class="cart-table-actions">
                          <form action="{{route('cart.destroy',$item->rowId)}}" method="POST">                           
                               {{csrf_field()}}
                               {{method_field('DELETE')}}             
                               <button type="submit" class="cart-options" style="margin-right:3px; font-size:15px">Remove</button>
                               
                           </form>
                          
                        </div> 
                    </div>
                </div> <!-- end cart-table-row -->
                @endforeach
                 
            </div> <!-- end cart-table -->

            <div class="cart-totals">
                <div class="cart-totals-left" style="font-size: 12px; text-align: center;">

                    Shipping is free when  when you buy more than 2000 din. 
                    In another case we use Faspost Shipping Service to provide delivery.
                </div>

                <div class="cart-totals-right">
                    <div>
                        Subtotal <br>
                        Pdv(20%)<br>
                        <span class="cart-totals-total">Total</span>
                    </div>
                    <div class="cart-totals-subtotal">
                        {{Cart::subtotal()}} <br>
                        {{Cart::tax()}} <br>
                        <span class="cart-totals-total">{{Cart::total()}} DIN</span>
                    </div>
                </div>
            </div> <!-- end cart-totals -->

            <div class="cart-buttons">
            <a href="{{route('shop.index')}}" class="button">Continue Shopping</a>
            <a href="{{route('checkout.index')}}" class="button-primary">Proceed to Checkout</a>
            </div>

            {{-- @else
               <h3>No items in Cart</h3>
               <div class="spacer"></div>
                <a href="{{route('shop.index')}}" class="button">Continue shopping</a>
                <div class="spacer"></div>

            @endif --}}
          @endif
           

        </div>

    </div> <!-- end cart-section -->

     @include('partials.might-like') 


@endsection
@section('extra-js')
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        (function(){
            const classname = document.querySelectorAll('.quantity')
            Array.from(classname).forEach(function(element) {
                element.addEventListener('change', function() {
                    const id = element.getAttribute('data-id')
                  
                    const productQuantity = element.getAttribute('data-productQuantity')
                    axios.patch(`/cart/${id}`, {
                        quantity: this.value,
                        productQuantity: productQuantity
                    })
                    .then(function (response) {                  
                        window.location.href = '{{ route('cart.index') }}'
                    })
                    .catch(function (error) {                    
                        window.location.href = '{{ route('cart.index') }}'
                    });
                })
            })
        })();
    </script>

@endsection
