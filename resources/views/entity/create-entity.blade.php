<div class="relative flex card p-2">
    <div class="lg:max-w-7xl">
        <div class="sm:columns-1 gap-6 lg:gap-8 text-white">
            <h4>Create Entity</h4>
            <small>An entity represents a table in your database.</small>
            <form class="flex flex-col gap-1" x-data="{ rows: 1, table_name: '', singular_name: ''}" action="{{ route("dashboard.store-entity", [ $project->id ]) }}" method="post">
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
                    <label for="column-is-key">Column is primary key?</label>
                    <label for="column-is-foreign-key">Is foreign key?</label>
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

                            
                            <div class="flex space-x-2" x-data="{is_foreign: false, foreign_entity_id: '', foreign_attr_id: ''}">
                                <input type="checkbox" x-model="is_foreign" x-effect="is_foreign ? '' : foreign_entity_id=''; foreign_attr_id='';" :name="'column-is-foreign-key-'+i" class="h-min">

                                <select class="p-1" x-on:change="is_foreign ? foreign_entity_id = $event.target.value : foreign_entity_id =''; foreign_attr_id='null';" x-show="is_foreign">
                                    <option class="text-zinc-200" value="null" x-bind:selected="foreign_entity_id == 'null'">Choose an entity...</option>
                                    @foreach($project->entities as $entity)
                                        <option class="text-zinc-200" value="{{ $entity->id }}">{{ $entity->display_name }}</option>
                                    @endforeach
                                </select>

                                <select class="p-1" x-model="foreign_attr_id" x-show="is_foreign && foreign_entity_id != ''">
                                    <option class="text-zinc-200" value="null" x-bind:selected="foreign_attr_id == 'null'">Choose an attribute...</option>
                                    @foreach($project->entities as $entity)
                                        @foreach($entity->attributes as $attribute)
                                            <option x-show="{{ $entity->id }} == foreign_entity_id" class="text-zinc-200" value="{{ $attribute->id }}">{{ $attribute->name }}</option>
                                        @endforeach
                                    @endforeach
                                </select>

                                <input type="hidden" x-bind:name="'foreign_attr_id_' + i" x-bind:disabled="foreign_attr_id == 'null'" x-model="foreign_attr_id">

                                <div x-text="foreign_entity_id"></div>
                                <div x-text="foreign_attr_id"></div>
                            </div>

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
