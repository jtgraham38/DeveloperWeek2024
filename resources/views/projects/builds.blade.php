<div class="card p-2">
    <h3 class="inline">{{$project->name}} Builds</h3> <small class="float-end">(Newest at top)</small>
    <hr>
    <table class="table-auto w-1/2 sm:w-full">
        <thead>
            <tr>
                <th class="text-left">Build</th>
                <th class="text-left">Created</th>
                <th></th>
            </tr>
        </thead>
        <tbody>

            @foreach($project->builds()->orderBy('created_at', 'desc')->get() as $build)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $build->created_at->format('Y-m-d H:i:s') }}</td>
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

    <div class="flex justify-center w-full mt-2">
        <form action="{{ route('builds.store') }}" method="POST" class="p-2 primary_btn">
            @csrf
            <input type="hidden" name="project_id" value={{ $project->id }}>
            <button type="submit">New Project Build</button>
        </form>
    </div>
</div>