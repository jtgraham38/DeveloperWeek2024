@extends('layouts.main')
@section('template')

    <div class="menu p-3 w-44 fixed inset-0 flex flex-col">
        <div>
            <details>
                <summary class="text-2xl">
                    @if(isset($project))
                        {{ $project->name }}
                    @else
                        Projects
                    @endif
                </summary>

                <ul>
                    @auth
                        @foreach(auth()->user()->projects as $_project)
                            <li class="my-1 px-2 hover:bg-slate-400 hover:bg-opacity-50 text-xl cursor-default {{ isset($project) && $project->id == $_project->id ? 'bg-amber-800' : '' }}" title="{{ isset($project) ? $project->description : '' }}">
                                <a href="{{ route('projects.edit', ['project' => $_project->id]) }}">
                                    <i class="fa-solid fa-layer-group"></i> {{ $_project->name }}
                                </a>
                            </li>
                        @endforeach
                    @endauth

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
        @if(isset($project))
            <div>
                <h5>Edit</h5>
                <hr>
                <div 
                    class="my-1 px-2 hover:bg-slate-400 hover:bg-opacity-50 text-lg"
                    hx-get="{{ route('projects.show', ['project'=>$project]) }}"
                    hx-target="#dashboard_body"
                    hx-indicator="#dashboard_loader"
                >
                    <span class="cursor-default">Overview</span>
                </div>
                <div
                    class="my-1 px-2 hover:bg-slate-400 hover:bg-opacity-50 text-lg"
                    hx-get="{{ route('projects.editor', ['project'=>$project]) }}"
                    hx-target="#dashboard_body"
                    hx-indicator="#dashboard_loader"
                >
                    <span class="cursor-default">Editor</span>
                </div>
                <div
                    class="my-1 px-2 hover:bg-slate-400 hover:bg-opacity-50 text-lg"
                    hx-get="{{ route('projects.settings', ['project'=>$project]) }}"
                    hx-target="#dashboard_body"
                    hx-indicator="#dashboard_loader"
                >
                    <span class="cursor-default">Settings</span>
                </div>
                <div
                    class="my-1 px-2 hover:bg-slate-400 hover:bg-opacity-50 text-lg"
                    hx-get="{{ route('projects.builds', ['project'=>$project]) }}"
                    hx-target="#dashboard_body"
                    hx-indicator="#dashboard_loader"
                >
                    <span class="cursor-default">Builds</span>
                </div>
            </div>
            <br>
        @endif
        @auth
            <div>
                <h5>Account</h5>
                <hr>
                <div
                    class="my-1 px-2 hover:bg-slate-400 hover:bg-opacity-50 text-lg"
                    hx-get="{{ route('users.edit', ['user'=>auth()->user()]) }}"
                    hx-target="#dashboard_body"
                    hx-indicator="#dashboard_loader"
                >
                    <span class="cursor-default">Settings</span>
                </div>
            </div>
        @endauth
    </div>

    <br>
    <br>

    @php
        //get the tab arg
        $tab = request()->input('p');

        //get the correct route
        $route = route('projects.index');
        if (isset($project)){
            switch ($tab) {
                case "editor":
                    $route = route('projects.editor', ['project'=>$project]);
                    break;
                case "settings":
                    $route = route('projects.settings', ['project'=>$project]);
                    break;
                case "builds":
                    $route = route('projects.builds', ['project'=>$project]);
                    break;
                default:
                    $route = route('projects.show', ['project'=>$project]);
            }
        }

    @endphp

    <div class="mx-auto px-4 ml-44 mr-4" hx-get="{{ $route }}" hx-target="#dashboard_body" hx-trigger="load">
        <i id="dashboard_loader" class="fa-spin htmx-indicator fa-solid fa-spinner fa-2xl text-zinc-200"></i>

        <div id="dashboard_body" class="p-3 text-zinc-200">
            @yield("body")
        </div>
    </div>


@endsection
