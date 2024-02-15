<div class="flex flex-col gap-4">
    <h3>{{ $project->name }} entities</h3>
    <div class="flex flex-row">
        <div class="flex flex-col">
            <a href="{{ route("dashboard.create-entity", [ $project->id ]) }}" class="primary_btn">
                <i class="fa fa-plus"></i> Add entity
            </a>
        </div>
    </div>
    <div class="flex flex-row columns-6">
        @foreach ($data as $item)
        <div class="flex flex-col">
            <p><b>{{ $item->name }}</b></p>
            <p>{{ $item->description }}</p>
            <p>{{ $item->table_name }}</p>
        </div>
        @endforeach
    </div>
</div>
