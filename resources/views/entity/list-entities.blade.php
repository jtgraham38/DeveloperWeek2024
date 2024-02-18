<div class="flex flex-col gap-4">
    <h3>{{ $project->name }} entities</h3>
    <div class="flex flex-row columns-6 gap-4">
        @foreach ($entities as $entity)
        <div class="flex flex-col">
            <p><b>{{ $entity->name }}</b></p>
            <p>{{ $entity->description }}</p>
            <p>{{ $entity->table_name }}</p>
        </div>
        @endforeach
    </div>
</div>
