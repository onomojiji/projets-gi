<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="{{asset("favicon.ico")}}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <title>@yield('title')</title>
</head>
<body>
    

    <section class="flex items-center h-full p-16 bg-gray-50 text-gray-800">
        <div class="container flex flex-col items-center justify-center px-5 mx-auto my-8">
            <div class="max-w-md text-center">
                <h2 class="mb-8 font-extrabold text-9xl text-gray-400">
                    <span class="sr-only">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">{{ __("Erreur")}}</font>
                        </font>
                    </span>
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">@yield('code')</font>
                    </font>
                </h2>
                <p class="text-2xl font-ssemibold md:text-3xl">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">@yield('message-title')</font>
                    </font>
                </p>
                <p class="mt-4 mb-8 text-gray-600">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">@yield('message-content')</font>
                    </font>
                </p>

                @yield('action-button')
                
            </div>
        </div>
    </section>

</body>
</html>