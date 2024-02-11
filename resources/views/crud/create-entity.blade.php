@extends("layouts.dashboard")
@section("body")
<div class="relative sm:flex sm:justify-center sm:items-center bg-dots-darker bg-center text-white">
    <div class="max-w-7xl mx-auto p-6 lg:p-8">
        <div class="sm:columns-1 gap-6 lg:gap-8">
            <form class="flex flex-col gap-1" x-data="{ rows: 1, table_name: '' }" action="/builds/{{$build_id}}/create-entity" method="post">
                <label for="entity-name">Entity name</label>
                <p class="text-sm text-gray-400">The human-readable name for this table, e.g. 'My table'</p>
                <input type="text" name="entity-name" id="entity-name" onkeyup="update_table_name()">
                <label for="entity-desc">Entity description</label>
                <textarea name="entity-desc" id="entity-desc" cols="30" rows="2"></textarea>
                <label for="table-name">Table name</label>
                <p class="text-sm text-gray-400">The machine name for this table, e.g. 'my_table'</p>
                <input type="text" name="table-name" id="table-name" x-text="table_name">
                <p>Table columns</p>
                <div class="grid grid-cols-2 gap-1 gap-x-2">
                    <label for="columns-datatype">Column data type</label>
                    <label for="columns-name">Column name</label>
                </div>

                <template x-for="i in rows">
                    <div class="grid grid-cols-2 gap-1 gap-x-2">
                            <select :name="'columns-datatype-' + i" id="columns-datatype">
                                <option value="int">int</option>
                                <option value="varchar">varchar</option>
                                <option value="bool">bool</option>
                            </select>
                            <input type="text" :name="'columns-name-' + i" id="columns-name" />
                    </div>
                </template>
                <div class="items-start">
                    <button type="button" @click="rows++" class="secondary_btn">Add column</button>
                    <button type="button" @click="rows > 1 && rows--" class="secondary_btn">Remove column</button>
                </div>
                <button type="submit" class="primary_btn">Submit</button>
            </form>
        </div>
    </div>
</div>

<script>
function update_table_name(){
    document.getElementById("table-name").value = document.getElementById("entity-name").value.toLowerCase().replaceAll(" ", "_");
}
</script>
@endsection
