<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Domaći pamuk</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat%7CRoboto:300,400,700" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">

    </head>
    <body>
        <div id="app">
            <header class="with-background">
                <div class="top-nav container">
                    <div class="top-nav-left">
                        
                            <div class="logo-left"> 
                                   <a href="" class="title" style="font-style: bold;color:white;font-size:25px;margin-right:15px">Decija radnja </a>                   
                                <img  src="/img/baby.svg" alt="kolica za bebe" style="height: 70%">                 
                            </div>
                   
                           {{menu('main','partials.menus.main')}}
                      </div>
    
                   <div class="top-nav-right">
                      @include('partials.menus.main-right') 
                    </div>
                </div> <!-- end top-nav -->
                <div class="hero container">
                    <div class="hero-copy">
                        <h1>Shop</h1>
                        <p>Ukoliko želite najbolje i najkvalitetnije za svoje dete kupujte kod nas.</p>
                  
                        <div class="hero-buttons">
                            <a href="http://localhost/testsite/" class="button button-white">Blog Post</a>
                            <a href="https://github.com/marijanatat/e-commerce" class="button button-white">GitHub</a>
                        </div>
                    </div> <!-- end hero-copy -->
    
                    <div class="hero-image">
                        <!--<img src="img/macbook-pro-laravel.png" alt="hero image">-->
                        <img src="img/deca.jpg" alt="deca">
                    </div> <!-- end hero-image -->
                </div> <!-- end hero -->
            </header>
    
            <div class="featured-section">
    
                <div class="container">
                    <h1 class="text-center">Shop</h1>
    
                    <p class="section-description text-center ">Naši proizvodi su isključivo domaće proizvodnje od najkvalitetnijeg 100% pamuka</p>
    
                    <div class="text-center button-container">
                        <a href="#" class="button">Featured</a>
                        <a href="#" class="button">On Sale</a>
                    </div>
    
                    {{-- <div class="tabs">
                        <div class="tab">
                            Featured
                        </div>
                        <div class="tab">
                            On Sale
                        </div>
                    </div> --}}
    
                    <div class="products text-center">
                        @foreach ($products as $product)
                        <div class="product">
                            <a href="{{route('shop.show',$product->slug)}}"><img src="{{productImage($product->image)}}" style="height:140px;" alt="product"></a>
                            <a href="{{route('shop.show',$product->slug)}}"><div class="product-name">{{$product->name}}</div></a>
                            <div class="product-price">{{$product->presentPrice()}}</div>
                        </div>
                        @endforeach
                       
                        
                    </div> <!-- end products -->
    
                    <div class="text-center button-container">
                        <a href="{{route('shop.index')}}" class="button">View more products</a>
                    </div>
    
                </div> <!-- end container -->
    
            </div> <!-- end featured-section -->
    
            
     
          <blog-posts></blog-posts>
            @include('partials.footer')
        </div>
        <script src="js/app.js"></script>


    </body>
</html>
