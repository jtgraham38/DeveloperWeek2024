@extends('layouts.main')
@section('template')

    <div class="menu p-3 w-36 fixed inset-0 flex flex-col">
        <div>
            <details>
                <summary class="text-2xl">
                    Builds
                </summary>

                <ul>
                    <li class="my-1 px-2 hover:bg-slate-400 hover:bg-opacity-50 text-xl">Project 1</li>
                    <li class="my-1 px-2 hover:bg-slate-400 hover:bg-opacity-50 text-xl">Build 2</li>
                    <li class="my-1 px-2 hover:bg-slate-400 hover:bg-opacity-50 text-xl">Item 3</li>
                </ul>

            </details>
        </div>
        <br>
        <div>
            <h5>Edit</h5>
            <hr>
            <div
                class="my-1 px-2 hover:bg-slate-400 hover:bg-opacity-50 text-lg"
                hx-get="{{ route('dashboard.builder') }}"
                hx-target="#dashboard_body"
                hx-indicator="#dashboard_loader"    
            >
                <span class="cursor-default">Builder</span>
            </div>
            <div 
                class="my-1 px-2 hover:bg-slate-400 hover:bg-opacity-50 text-lg"
                hx-get="{{ route('dashboard.settings') }}"
                hx-target="#dashboard_body"
                hx-indicator="#dashboard_loader"
            >
                <span class="cursor-default">Settings</span>
            </div>
        </div>
        <br>
        <div>
            <h5>Account</h5>
            <hr>
            <div 
                class="my-1 px-2 hover:bg-slate-400 hover:bg-opacity-50 text-lg"
                hx-get="{{ route('dashboard.settings') }}"
                hx-target="#dashboard_body"
                hx-indicator="#dashboard_loader"
            >
                <span class="cursor-default">Settings</span>
            </div>
        </div>
    </div>

    <br>
    <br>

    <div class="container mx-auto px-4 ml-36" hx-get="{{ route('dashboard.builder') }}" hx-target="#dashboard_body" hx-trigger="load">
        <i id="dashboard_loader" class="fa-spin htmx-indicator fa-solid fa-spinner  fa-2xl text-zinc-200"></i>

        <div id="dashboard_body" class="flex-grow p-3 text-zinc-200">
            
        </div>
    </div>

    
@endsection
