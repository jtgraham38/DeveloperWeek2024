@extends('layouts.main')
@section('template')
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

    <div class="menu p-3 w-36 fixed inset-0 mt-12 flex flex-col">
        <div>
            <h4>Menu</h4>
            <hr>
            <div class="my-1 px-2 hover:bg-slate-400 hover:bg-opacity-50 text-lg">
                <a href="#">Tab 1</a>
            </div>
            <div class="my-1 px-2 hover:bg-slate-400 hover:bg-opacity-50 text-lg">
                <a href="#">Tab 2</a>
            </div>
        </div>
    </div>

    <br>
    <br>
    <br>
    <br>
    <br>

    <div class="container mx-auto px-4">
        
        
        <div class="flex-grow p-3 ml-36">
            @yield('body')
        </div>
    </div>

    
@endsection
