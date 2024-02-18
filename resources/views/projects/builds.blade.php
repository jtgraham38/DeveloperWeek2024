<div class="card p-2">
    <h3>{{$project->name}} Builds</h3>
    <hr>
    <table class="table-auto w-1/2 sm:w-full">
        <thead>
            <tr>
                <th>Build</th>
                <th>Created</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>

            @foreach($project->builds as $build)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $build->created_at->format('Y-m-d') }}</td>
                <td>
                    <form action="{{ route('builds.destroy', ['build'=>$build]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                </td>
                <td>
                    <a href="{{ route('builds.download', ['build'=>$build]) }}">
                        <i class="fa-solid fa-download"></i>
                    </a>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>