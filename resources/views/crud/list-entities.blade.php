<div class="flex flex-col gap-4">
    <h3>{{ $project->name }} entities</h3>
    <div class="flex-col">
        <div hx-get="{{ route("dashboard.create-entity", [ $project->id ]) }} hx-target="#dashboard_body" hx-indicator="#dashboard_loader" class="primary_btn"><i class="fa fa-plus"></i> Add entity</div>
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
