 @extends('layout')

@section('title', 'About')


 @section('content')

@component('components.breadcrumbs')
    <a href="/">Home</a>
    <i class="fa fa-chevron-right breadcrumb-separator"></i>
    <span>About</span>
@endcomponent  
{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    {!!$map['js']!!}
</head>
<body>
    
</body>
</html> --}}
<div class="container">
    <div>
        <h2 style="font-size:24px ">Naša priča</h2>
        <div class="spacer"></div>
        <h2>Mobing Odžaci str</h2>
        <h3>Somborska 38</h3>
        <div class="short-left-line">
            <div></div>
        </div>
        <p> Naša radnja se nalazi u Odžacima. Mi smo već 10 godina tu za vas. Negujemo kvalitet i pristupačne cene. Bićemo tu još dugo.<br></p><p>
         <br>
         Bićemo zu još dugo.</p><p>

    </div>
    {{-- {!!$map['html']!!} --}}
     <div>
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d1398.1260028649447!2d19.257321988241856!3d45.50500542734718!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ssr!2srs!4v1594243180190!5m2!1ssr!2srs" width="1000" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        {{-- <a href=" https://goo.gl/maps/9RMDBg9tPimquJMy9" target="_new" rel="nofollow"><img src="https://www.gobluemedia.com/wp-content/uploads/2020/01/Oberlin-Drive-San-Diego.jpg" alt="Oberlin Drive San Diego"></a> --}}
    </div> 
</div>
 @endsection 

