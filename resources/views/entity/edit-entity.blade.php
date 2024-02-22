<div class="relative flex">
    <div class="lg:max-w-7xl">
        <div class="sm:columns-1 gap-6 lg:gap-8 text-white">
            <h4>Edit entity</h4>
            <form class="flex flex-col gap-1" x-data="{ rows: 0, table_name: '' }" action="{{ route("entity.update", [ $entity->id ]) }}" method="post">
                @csrf
                {{-- Entity name input --}}
                <label for="entity-name">Entity name</label>
                <p class="text-sm text-gray-400">The human-readable name for this table, e.g. 'My table'</p>
                <input type="text" name="entity-name" id="entity-name" onkeyup="update_table_name()" value="{{$entity->display_name}}" required>

                {{-- Entity description --}}
                <label for="entity-desc">Entity description</label>
                <textarea name="entity-desc" id="entity-desc" cols="30" rows="2">{{$entity->description}}</textarea>

                {{-- Table name --}}
                <label for="table-name">Table name</label>
                <p class="text-sm text-gray-400">The machine name for this table, e.g. 'my_table'</p>
                <input type="text" name="table-name" id="table-name" x-text="table_name" value="{{$entity->table_name}}" required>

                {{-- Singular name --}}
                <label for="table-name">Singular name</label>
                <p class="text-sm text-zinc-400">Singular name for an entry in this table, used in instances like cacti/cactus, etc.</p>
                <input type="text" name="singular-name" id="singular-name" value="{{$entity->singular_name}}" required>

                @if (count($entity_attributes))
                    {{-- Table columns --}}
                    <p>Edit/delete table columns</p>
                    <div class="grid grid-cols-5 gap-1 gap-x-2">
                        <label>Column data type</label>
                        <label>Column name</label>
                        <label>Column is key?</label>
                        <label>References column</label>
                        <label>Delete column</label>
                    </div>

                    <div class="grid grid-cols-5 gap-1 gap-x-2">
                        @foreach ($entity_attributes as $i=>$attribute)
                            <input type="text" name="{{ 'column-id-'.$i }}" value="{{ $attribute->id }}" hidden>
                            <select name="{{ 'column-datatype-'.$i }}" required>
                                <option value="int" @if ($attribute->type == "int") selected @endif>int</option>
                                <option value="varchar" @if ($attribute->type == "varchar") selected @endif>varchar</option>
                                <option value="bool" @if ($attribute->type == "bool") selected @endif>bool</option>
                            </select>
                            <input type="text" name="{{ 'column-name-'.$i }}" class="mb-0" value="{{ $attribute->name }}" required>
                            <input type="checkbox" name="{{ 'column-is-key-'.$i }}" class="h-min" @if ($attribute->is_key == true) checked @endif>
                            <select name="{{ 'column-is-foreign-key-'.$i }}">
                                <option value="none">None</option>
                                @foreach ($other_attributes as $attr)
                                    @if ($attr->entity_id != $entity->id)
                                        <option value="{{$attr->id}}" @if ($attribute->foreign_id == $attr->id) selected @endif>{{ $attr->name }} ({{ $other_entities[$attr->entity_id]["display_name"] }})</option>
                                    @endif
                                @endforeach
                            </select>
                            <input type="checkbox" name="{{ 'delete-column-'.$i }}">
                        @endforeach
                    </div>
                @endif

                <p>Add table columns</p>
                <div class="grid grid-cols-4 gap-1 gap-x-2">
                    <label>Column data type</label>
                    <label>Column name</label>
                    <label>Column is key?</label>
                    <label>References column</label>
                </div>
                {{-- Alpine-powered row duplication --}}
                <template x-for="i in rows">
                    <div class="grid grid-cols-4 gap-1 gap-x-2">
                        <select :name="'new-column-datatype-'+i" required>
                            <option value="int">int</option>
                            <option value="varchar">varchar</option>
                            <option value="bool">bool</option>
                        </select>
                        <input type="text" :name="'new-column-name-'+i" class="mb-0" required>
                        <input type="checkbox" :name="'new-column-is-key-'+i" class="h-min">
                        <select :name="'column-is-foreign-key-'+i">
                            <option value="none">None</option>
                            @foreach ($other_attributes as $attr)
                                @if ($attr->entity_id != $entity->id)
                                    <option value="{{$attr->id}}">{{ $attr->name }} ({{ $other_entities[$attr->entity_id]["display_name"] }})</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </template>

                <input type="number" name="row-count" x-model="rows" hidden>
                <div class="items-start">
                    <button type="button" @click="rows++" class="secondary_btn">Add column</button>
                    <button type="button" @click="rows > 0 && rows--" class="secondary_btn">Remove column</button>
                </div>
                <div class="flex items-center gap-2 py-2">
                    <input type="checkbox" class="mb-0" name="is-private" id="is-private">
                    <label for="is-private">Private?</label>
                </div>
                <div class="flex justify-between">
                    <button type="submit" class="primary_btn">Submit</button>
                    <button type="button" onclick="delete_confirmation.showModal();" class="secondary_btn"><i class="fa fa-trash"></i> Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<x-modal id="delete_confirmation">
<div class="flex flex-col m-2 gap-2">
    <h4>Confirm deletion of {{ $entity->display_name }}:</h4>
    <div class="flex flex-row justify-between">
        <a href="{{ route("entity.delete", [ $entity->id ]) }}" class="secondary_btn"><i class="fa fa-trash"></i> Yes, delete</a>
        <button onclick="delete_confirmation.close()" class="primary_btn"><i class="fa-solid fa-xmark"></i> Cancel</a>
    </div>
</div>
</x-modal>

<script>
function update_table_name(){
    document.getElementById("table-name").value = document.getElementById("entity-name").value.toLowerCase().replaceAll(" ", "_");
}
</script>
