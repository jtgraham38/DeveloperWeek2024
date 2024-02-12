@extends('layouts.main')
@section('template')

    <div class="menu p-3 w-40 fixed inset-0 flex flex-col">
        <div>
            <details>
                <summary class="text-2xl">
                    Builds
                </summary>

                <ul>
                    <li class="my-1 px-2 hover:bg-slate-400 hover:bg-opacity-50 text-xl cursor-default"> <i class="fa-solid fa-layer-group"></i> Project 1</li>
                    <li class="my-1 px-2 hover:bg-slate-400 hover:bg-opacity-50 text-xl cursor-default"> <i class="fa-solid fa-layer-group"></i> Build 2</li>
                    <li class="my-1 px-2 hover:bg-slate-400 hover:bg-opacity-50 text-xl cursor-default"> <i class="fa-solid fa-layer-group"></i> Item 3</li>

                    <li class="my-1 px-2 hover:bg-slate-400 hover:bg-opacity-50 text-xl cursor-default">
                        <button onclick="create_build_modal.showModal();"><i class="fa-solid fa-circle-plus"></i> New Project</button>
                    </li>
                </ul>

                <x-modal id="create_build_modal">
                    @include('projects.create')
                </x-modal>

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

    <div class="container mx-auto px-4 ml-40" hx-get="{{ route('dashboard.builder') }}" hx-target="#dashboard_body" hx-trigger="load">
        <i id="dashboard_loader" class="fa-spin htmx-indicator fa-solid fa-spinner  fa-2xl text-zinc-200"></i>

        <div id="dashboard_body" class="flex-grow p-3 text-zinc-200">
            
        </div>
    </div>

    
@endsection
