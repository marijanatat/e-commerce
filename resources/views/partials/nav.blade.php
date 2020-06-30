<header>
    <div class="top-nav container">
        <div class="logo">
            <a href="/"><img src="/img/baby.svg" alt="kolica za bebe" style="height:35px; solid;padding:2px;"></a>
                <a href="/"><h4 style="">Dečija radnja</h4></a>
            
        </div>

    
        @if (! request()->is('checkout'))

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
    </div> <!-- end top-nav -->
</header>
