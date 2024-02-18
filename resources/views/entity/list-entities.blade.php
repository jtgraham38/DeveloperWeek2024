<div class="flex flex-col gap-4">
    <h3>{{ $project->name }} entities</h3>
    <div class="flex flex-row columns-6 gap-4">
        @foreach ($data as $item)
        <div class="flex flex-col">
            <p><b>{{ $item->display_name }}</b></p>
            <p>{{ $item->description }}</p>
            <p>{{ $item->table_name }}</p>
        </div>
        @endforeach
    </div>
</div>
