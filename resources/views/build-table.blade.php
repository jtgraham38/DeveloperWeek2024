@extends("layouts.main")
@section("template")
<div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center text-white">
    <div class="max-w-7xl mx-auto p-6 lg:p-8">
        <div class="mt-16">
            <div class="sm:columns-1 gap-6 lg:gap-8">
                <form class="flex flex-col gap-1" x-data="{ rows: 1 }" action="/upload" method="post">
                    <h3 class="text-xl">Set up columns</h3>
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
</div>
@endsection
