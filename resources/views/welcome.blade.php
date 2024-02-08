@extends('layouts.dashboard')
@section('body')
    @auth
        <div class="decoration-sky-500/30">
            <p>Welcome, {{ auth()->user()->name }}</p>

            <form action="{{ route('logout') }}" method="POST" class="my-0">
                @csrf
                <button onclick="signup_modal.showModal();" class="hover:text-slate-400" href="#" type="submit">Log Out <i class="fa-solid fa-right-from-bracket"></i></button>
            </form>
        </div>
    @else
        <div class="flex flex-row justify-between">
            <div class="border">
                @if ($errors->any())
                    <div style="border: 1px solid gray;">
                        <h3>Errors</h3>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @include('users.auth')
            </div>
            <div class="border">

                @if ($errors->any())
                    <div style="border: 1px solid gray;">
                        <h3>Errors</h3>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                @include('users.create')
            </div>
        </div>
    @endauth

    <br>
    <br>
    <button class="secondary_btn">Hi there secnondary button!</button>

    <br>
    <br>
    <div class="card p-2">
        <h4>Cards!</h4>
        <hr>
        <ul>
            <li>this is a card</li>
            <li>it is used for</li>
            <li>holding content</li>
            <li>!!!!!</li>
        </ul>
    </div>
@endsection
