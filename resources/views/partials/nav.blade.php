<header>
    <div class="top-nav container">
        <div class="top-nav-left">
            <div class="logo-left"> 
                <a href="/" class="title" style="font-style: bold;color:white;font-size:25px;margin-right:10px">Dečija radnja </a>                   
                 <img  src="/img/baby.svg" alt="kolica za bebe" style="height: 70%;">                 
            </div>
    
            @if (!( request()->is('checkout')||request()->is('guestCheckout')))
               {{menu('main','partials.menus.main')}}
       
        {{-- <ul>
            <li><a href="{{route('shop.index')}}">Shop</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Blog</a></li>
            <li>
                <a href="{{route('cart.index')}}">Cart <span class="cart-count">
                    @if (Cart::instance('default')->count()>0)
                    <span>{{Cart::instance('default')->count()}}</span>                
                    @endif
                   
                </span>
                </a></li>
        </ul> --}}
        @endif
    </div>

    <div class="top-nav-right">
        @if (!( request()->is('checkout')||request()->is('guestCheckout')))
              @include('partials.menus.main-right')
        @endif
    </div>
    </div> <!-- end top-nav -->
</header>
