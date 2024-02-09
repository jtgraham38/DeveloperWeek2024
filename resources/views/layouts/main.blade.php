<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        @vite('resources/css/fonts.css')
        @vite('resources/css/style.css')
        <script src="https://kit.fontawesome.com/838b689285.js" crossorigin="anonymous"></script>

        <script src="https://unpkg.com/alpinejs" defer></script>
        <script src="https://unpkg.com/htmx.org@1.9.10" integrity="sha384-D1Kt99CQMDuVetoL1lrYwg5t+9QdHe7NLX/SoJYkXDFfX37iInKRy5xLSi8nO7UC" crossorigin="anonymous"></script>

    </head>
    <body>

        @include('navigation')

        @yield('template')

        <div class="fixed bottom-4 right-4">
            @if($errors->any())
                <div class="p-4 bg-red-300 bg-opacity-50 shadow-md">
                    <div class="flex justify-between">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>


                        <button class="ml-4 hover:text-slate-400" onclick="event.target.parentNode.parentNode.parentNode.remove()"><i class="fa-solid fa-x"></i></button>
                    </div>
                </div>
            @endif
            @if(session()->has('message'))
                <div class="p-4 card ">
                    {{ session()->get('message') }}
                    <button class="ml-4 hover:text-slate-400" onclick="event.target.parentNode.parentNode.remove()"><i class="fa-solid fa-x"></i></button>
                </div>
            @endif
        </div>

    </body>
</html>
