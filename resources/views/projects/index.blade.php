<div class="columns-2 gap-4">
    @foreach (auth()->user()->projects as $project)
        <div class="card p-2">
            <h3>{{ $project->name }}</h3>
            <hr>
            <p class="p-2">
                {{ $project->description }}
            </p>
            <div class="flex justify-center">
                <a href="{{ route('projects.edit', ['project'=>$project]) }}" class="secondary_btn">Edit</a>
            </div>
        </div>
    @endforeach
</div>