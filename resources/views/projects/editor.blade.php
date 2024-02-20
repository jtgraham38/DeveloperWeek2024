Editor for project:
{{ $project->id }}

<div class="flex flex-row">
    @foreach ($entities as $entity)
    <a hx-get="{{ route('entity.edit', [ $project, $entity ]) }}" hx-target="#dashboard_body" hx-indicator="#dashboard_loader">
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

@include("entity.create-entity")
