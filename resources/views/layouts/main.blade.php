<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        @vite('resources/css/fonts.css')
        @vite('resources/css/style.css')
        <script src="https://kit.fontawesome.com/838b689285.js" crossorigin="anonymous"></script>

    </head>
    <body>

        <header class="menu p-3 mb-3 flex flex-row justify-between">
            <div>
                <a href="#" class="hover:text-zinc-400">API Builder</a>
            </div>
            <div class="flex">
                @guest
                    <button onclick="login_modal.showModal();" class="hover:text-zinc-400" href="#">Login <i class="fa-solid fa-right-to-bracket"></i></button>
                    <span class="ml-2">or</span>
                    <button onclick="signup_modal.showModal();" class="hover:text-zinc-400 ml-2" href="#">Sign Up <i class="fa-solid fa-user-plus"></i></button>
                @else
                    <form action="{{ route('logout') }}" method="POST" class="my-0">
                        @csrf
                        <button onclick="signup_modal.showModal();" class="hover:text-zinc-400" href="#" type="submit">Log Out <i class="fa-solid fa-right-from-bracket"></i></button>
                    </form>
                @endguest
            </div>
        </header>
        
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
