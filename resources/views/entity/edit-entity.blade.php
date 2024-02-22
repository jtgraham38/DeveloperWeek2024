<h5>This page is bugged!  There is use of an alpine for and a blade for to generate input names, but they both count by ones, so we have duplicate input names on the same form.</h5>

<div class="relative flex">
    <div class="lg:max-w-7xl">
        <div class="sm:columns-1 gap-6 lg:gap-8 text-white">
        <div class="card p-2">
            <h4>Edit Entity</h4>
            <form class="flex flex-col gap-1" x-data="{ rows: 0, table_name: '', singular_name: ''}" action="{{ route("entity.update", [ $entity->id ]) }}" method="post">
                @csrf
                {{-- Entity name input --}}
                <label for="entity-name">Entity name</label>
                <p class="text-sm text-gray-400">The human-readable name for this table, e.g. 'My table'</p>
                <input type="text" name="entity-name" id="entity-name" onkeyup="update_table_name()" value="{{$entity->display_name}}">

                {{-- Entity description --}}
                <label for="entity-desc">Entity description</label>
                <textarea name="entity-desc" id="entity-desc" cols="30" rows="2">{{$entity->description}}</textarea>

                {{-- Table name --}}
                <label for="table-name">Table name</label>
                <p class="text-sm text-gray-400">The machine name for this table, e.g. 'my_table'</p>
                <input type="text" name="table-name" id="table-name" x-text="table_name" value="{{$entity->table_name}}">

                @if (count($entity_attributes))
                    {{-- Table columns --}}
                    <p>Edit/delete table columns</p>
                    <div class="grid grid-cols-5 gap-1 gap-x-2">
                        <label>Column data type</label>
                        <label>Column name</label>
                        <label>Column is key?</label>
                        <label>Key is foreign?</label>
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
                            <input type="checkbox" name="{{ 'column-is-key-'.$i }}" class="h-min" checked="{{ $attribute->is_key }}">
                            

                            <div class="flex space-x-2" x-data="{is_foreign: {{ isset($attribute->foreign_attribute) ? 'true' : 'false' }}, foreign_entity_id: {{ isset($attribute->foreign_attribute->entity->id) ? $attribute->foreign_attribute->entity->id : "''" }}, foreign_attr_id: {{ isset($attribute->foreign_attribute->id) ? $attribute->foreign_attribute->id : "''"}}}">
                                <input type="checkbox" x-model="is_foreign" x-effect="is_foreign ? '' : foreign_entity_id=''; foreign_attr_id='';" :name="'column-is-foreign-key-'+i" class="h-min">

                                <select class="p-1" x-on:change="is_foreign ? foreign_entity_id = $event.target.value : foreign_entity_id =''; foreign_attr_id='null';" x-show="is_foreign">
                                    <option class="text-zinc-200" value="null" x-bind:selected="foreign_entity_id == 'null'">Choose an entity...</option>
                                    @foreach($entity->project->entities as $entity)
                                        <option {{ isset($attribute->foreign_attribute) && $attribute->foreign_attribute->entity->id == $entity->id ? 'selected' : '' }} class="text-zinc-200" value="{{ $entity->id }}">{{ $entity->display_name }}</option>
                                    @endforeach
                                </select>

                                <select class="p-1" x-model="foreign_attr_id" x-show="is_foreign && foreign_entity_id != ''">
                                    <option class="text-zinc-200" value="null" x-bind:selected="foreign_attr_id == 'null'">Choose an attribute...</option>
                                    @foreach($entity->project->entities as $entity)
                                        @foreach($entity->attributes as $_attribute)
                                            <option {{ isset($attribute->foreign_attribute) && $attribute->foreign_attribute->id == $_attribute->id ? 'selected' : '' }} x-show="{{ $entity->id }} == foreign_entity_id" class="text-zinc-200" value="{{ $_attribute->id }}">{{ $_attribute->name }}</option>
                                        @endforeach
                                    @endforeach
                                </select>

                                <input type="hidden" x-bind:name="'foreign_attr_id_' + {{ $i }}" x-bind:disabled="foreign_attr_id == 'null'" x-model="foreign_attr_id">
                            </div>

                            <input type="checkbox" name="{{ 'delete-column-'.$i }}">
                        @endforeach
                    </div>
                @endif

                <p>Add table columns</p>
                <div class="grid grid-cols-4 gap-1 gap-x-2">
                    <label>Column data type</label>
                    <label>Column name</label>
                    <label>Column is key?</label>
                    <label>Key is foreign?</label>
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

                        <div class="flex space-x-2" x-data="{is_foreign: false, foreign_entity_id: '', foreign_attr_id: ''}">
                            <input type="checkbox" x-model="is_foreign" x-effect="is_foreign ? '' : foreign_entity_id=''; foreign_attr_id='';" :name="'column-is-foreign-key-'+i" class="h-min">

                            <select class="p-1" x-on:change="is_foreign ? foreign_entity_id = $event.target.value : foreign_entity_id =''; foreign_attr_id='null';" x-show="is_foreign">
                                <option class="text-zinc-200" value="null" x-bind:selected="foreign_entity_id == 'null'">Choose an entity...</option>
                                @foreach($entity->project->entities as $entity)
                                    <option class="text-zinc-200" value="{{ $entity->id }}">{{ $entity->display_name }}</option>
                                @endforeach
                            </select>

                            <select class="p-1" x-model="foreign_attr_id" x-show="is_foreign && foreign_entity_id != ''">
                                <option class="text-zinc-200" value="null" x-bind:selected="foreign_attr_id == 'null'">Choose an attribute...</option>
                                @foreach($entity->project->entities as $entity)
                                    @foreach($entity->attributes as $attribute)
                                        <option x-show="{{ $entity->id }} == foreign_entity_id" class="text-zinc-200" value="{{ $attribute->id }}">{{ $attribute->name }}</option>
                                    @endforeach
                                @endforeach
                            </select>

                            <input type="hidden" x-bind:name="'foreign_attr_id_' + i" x-bind:disabled="foreign_attr_id == 'null'" x-model="foreign_attr_id">
                        </div>

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
                <div class="flex space-x-2">
                    <button type="submit" class="primary_btn">Submit</button>
                    <button type="button" class="secondary_btn" hx-get="{{ route('projects.editor', ['project'=>$entity->project]) }}" hx-target="#dashboard_body" hx-indicator="#dashboard_loader">Cancel</button>
                    {{-- NOTE: the above line contains an extra db call, fix later --}}
                </div>
            </form>
        </div>
        </div>
    </div>
</div>

<script>
function update_table_name(){
    document.getElementById("table-name").value = document.getElementById("entity-name").value.toLowerCase().replaceAll(" ", "_");
}
</script>