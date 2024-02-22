<div class="relative flex card p-2">
    <div class="lg:max-w-7xl">
        <div class="sm:columns-1 gap-6 lg:gap-8 text-white">
            <h4>Create Entity</h4>
            <small>An entity represents a table in your database.</small>
            <form class="flex flex-col gap-1" x-data="{ rows: 1, table_name: '' }" action="{{ route("dashboard.store-entity", [ $project->id ]) }}" method="post">
                @csrf
                {{-- Entity name input --}}
                <label for="entity-name">Entity name</label>
                <p class="text-sm text-zinc-400">The human-readable name for this table, e.g. 'My table'</p>
                <input type="text" name="entity-name" id="entity-name" onkeyup="update_table_name()">

                {{-- Entity description --}}
                <label for="entity-desc">Entity description</label>
                <textarea name="entity-desc" class="text-zinc-400" id="entity-desc" cols="30" rows="2"></textarea>

                {{-- Table name --}}
                <label for="table-name">Table name</label>
                <p class="text-sm text-zinc-400">The machine name for this table, e.g. 'my_table'</p>
                <input type="text" name="table-name" id="table-name" x-text="table_name">

                {{-- Table name --}}
                <label for="table-name">Singular name</label>
                <p class="text-sm text-zinc-400">Singular name for an entry in this table, used in instances like cacti/cactus, etc.</p>
                <input type="text" name="singular-name" id="singular-name" x-text="singular_name">

                {{-- Table columns --}}
                <p>Table columns</p>
                <div class="grid grid-cols-4 gap-1 gap-x-2">
                    <label for="column-datatype">Column data type</label>
                    <label for="column-name">Column name</label>
                    <label for="column-is-key">Column is key?</label>
                    <label for="column-is-foreign-key">Key is foreign?</label>
                </div>
                {{-- Alpine-powered row duplication --}}
                <template x-for="i in rows">
                    <div class="grid grid-cols-4 gap-1 gap-x-2">
                            <select :name="'column-datatype-'+i" required>
                                <option value="int">int</option>
                                <option value="varchar">varchar</option>
                                <option value="bool">bool</option>
                            </select>
                            <input type="text" :name="'column-name-'+i" class="mb-0" required>
                            <input type="checkbox" :name="'column-is-key-'+i" class="h-min">
                            <input type="checkbox" :name="'column-is-foreign-key-'+i" class="h-min">
                    </div>
                </template>
                <input type="number" name="row-count" x-model="rows" hidden>
                <div class="items-start">
                    <button type="button" @click="rows++" class="secondary_btn">Add column</button>
                    <button type="button" @click="rows > 1 && rows--" class="secondary_btn">Remove column</button>
                </div>
                <div class="flex items-center gap-2 py-2">
                    <input type="checkbox" class="mb-0" name="is-private" id="is-private">
                    <label for="is-private">Private?</label>
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
