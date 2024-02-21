<div class="flex flex-row space-x-4">
    <div class="p-2 card w-1/2">
        <h3>About {{ $project->name }}</h3>
        <hr>
        <br>
        <h5>Summary</h5>
        <div class="px-2">
            <strong class="mr-2">Description:</strong>
        </div>

        <div class="px-2 flex flex-row justify-between">
            <div>
                <strong class="mr-2">Project Output Type:</strong>{{$project->output_type}}
            </div>
            <div>
                <strong class="mr-2">Project Database Type:</strong>{{$project->db_type}}
            </div>
        </div>

        <div class="px-2 flex flex-row justify-between">
            <div>
                <strong class="mr-2">Created:</strong>{{$project->created_at->format('Y-m-d');}}
            </div>
            <div>
                <strong class="mr-2">Last Changed:</strong>{{$project->updated_at->format('Y-m-d');}}
            </div>
        </div>

        <div class="flex justify-center">
            <a href="{{ route('projects.edit', ['project'=>$project]) }}" class="secondary_btn">Project Details</a>
        </div>

        <h5>Entities</h5>
        <div class="px-2">
            @include("entity.list-entities")
        </div>
        <div class="flex justify-center">
            <a href="{{ route('projects.edit', ['project'=>$project]) }}" class="secondary_btn">Edit Project</a>
        </div>
    </div>

    <div class="p-2 card w-1/2">
        <h3>{{ $project->name }} Builds</h3>
        <hr>
        <br>
        <h5>Past Builds</h5>
        <div class="px-2">
            <table class="table-auto w-1/2 sm:w-full">
                <thead>
                    <tr>
                        <th class="text-left">Build</th>
                        <th class="text-left">Created</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
        
                    @foreach($project->builds()->orderBy('created_at', 'desc')->take(5)->get() as $build)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $build->created_at->format('Y-m-d H:i') }}</td>
                            <td class="flex align-items-center">
                                <form action="{{ route('builds.destroy', ['build'=>$build]) }}" method="POST" class="mr-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">
                                        <i class="fa-solid fa-trash hover:text-zinc-400"></i>
                                    </button>
                                </form>
                                <div class="flex flex-col justify-center">
                                    <a href="{{ route('builds.download', ['build'=>$build]) }}">
                                        <i class="fa-solid fa-download hover:text-zinc-400"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
        
                </tbody>
            </table>
            <div class="flex justify-center">
                <a href="{{ route('projects.edit', ['project'=>$project]) }}" class="secondary_btn">See all Builds</a>
            </div>
        </div>
    </div>
</div>
