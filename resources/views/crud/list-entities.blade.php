@extends("layouts.dashboard")
@section("body")
<div class="flex flex-col gap-4">
    <h3>{{ $build->name }} entities</h3>
    <div class="flex-col">
        <a href="/builds/{{$build->id}}/create-entity" class="primary_btn">+ Add entity</a>
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
@endsection