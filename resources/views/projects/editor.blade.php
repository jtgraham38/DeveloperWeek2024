


<div class="card p-2">
    <h3>Editor for {{ $project->name }}</h3>
    <hr>
    <div class="card p-2 flex flex-row space-x-2">
        @foreach ($entities as $entity)
        <a hx-get="{{ route('entity.edit', [ $entity->id ]) }}" hx-target="#dashboard_body" hx-indicator="#dashboard_loader" class="cursor-pointer">
            <div class="border-2 border-gray-600 hover:border-primary-red rounded-md">
                <div class="flex flex-col m-1 p-2 bg-gray-600">
                    <p><b>{{ $entity->display_name }}</b></p>
                    <p>{{ $entity->description }}</p>
                    <p>{{ $entity->table_name }}</p>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</div>

<div class="mt-2">
    @include("entity.create-entity")
</div>
