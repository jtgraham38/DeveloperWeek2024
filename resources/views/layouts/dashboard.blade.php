@extends('layouts.main')
@section('template')

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
