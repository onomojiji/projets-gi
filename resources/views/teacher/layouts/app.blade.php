<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="{{asset("favicon.ico")}}" type="image/x-icon">
        <title>{{__("Projets GI")}}</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{asset("assets/plugins/fontawesome-free/css/all.min.css")}} ">
        @yield('css')
    </head>
    <body> 
    
        @include("teacher.layouts.navbar")

        <div class="container-fluid">
            <div class="my-3">
                @yield("content")
            </div>
            @include("teacher.layouts.footer")
        </div>
  
        @yield('js')

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    </body>
</html>
