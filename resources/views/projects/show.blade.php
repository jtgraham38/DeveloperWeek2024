<div class="flex flex-row space-x-4">
    <div class="p-2 card w-1/2">
        <h3>About {{ $project->name }}</h3>
        <hr>
        <br>
        <h5>Summary</h5>
        <div class="px-2">
            <span class="mr-2">Description:</span>{{ $project->description }}
        </div>

        <div class="px-2 flex flex-row justify-between">
            <div>
                <span class="mr-2">Project Output Type:</span>{{$project->output_type}}
            </div>
            <div>
                <span class="mr-2">Project Database Type:</span>{{$project->db_type}}
            </div>
        </div>

        <div class="px-2 flex flex-row justify-between">
            <div>
                <span class="mr-2">Created:</span>{{$project->created_at->format('Y-m-d');}}
            </div>
            <div>
                <span class="mr-2">Last Changed:</span>{{$project->updated_at->format('Y-m-d');}}
            </div>
        </div>

        <h5>Entities</h5>
        <div class="px-2">
            @include("entity.list-entities")
        </div>
    </div>

    <div class="p-2 card w-1/2">
        <h3>{{ $project->name }} Builds</h3>
        <hr>
        <br>
        <h5>Past Builds</h5>
        <div class="px-2">
            Summary of hisoric builds here.
        </div>

        <h5>Routes</h5>
        <div class="px-2">
            Route summary here.
        </div>
    </div>
</div>

<div class="flex justify-center w-full mt-2">
    <a href="{{route('projects.build', ['project'=>$project])}}" class="primary_btn p-2">Build Project</a>
</div>
