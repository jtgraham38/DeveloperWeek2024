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
                    <form action="#">
                        @csrf
                        <button type="submit">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                </td>
                <td>
                    <form action="#">
                        @csrf
                        <button type="submit">
                            <i class="fa-solid fa-download"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>