<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite('resources/css/app.css')
</head>

<body class="antialiased">

    <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 dark:text-white selection:bg-red-500 selection:text-white">
        <div class="max-w-7xl mx-auto p-6 lg:p-8">
            <div class="mt-16">
                <div class="sm:columns-1 gap-6 lg:gap-8">
                    <form class="flex flex-col gap-1" x-data="{ rows: 1 }" action="/upload" method="post">
                        <h3 class="text-xl">Set up columns</h3>
                        <div class="grid grid-cols-2 gap-1 gap-x-2 text-black">
                            <label for="columns-datatype" class="text-white">Column data type</label>
                            <label for="columns-name" class="text-white">Column name</label>
                        </div>

                        <template x-for="i in rows">
                            <div class="grid grid-cols-2 gap-1 gap-x-2 mb-1 text-black">
                                    <select :name="'columns-datatype-' + i" class="bg-zinc-400 p-2" id="columns-datatype">
                                        <option value="int">int</option>
                                        <option value="varchar">varchar</option>
                                        <option value="bool">bool</option>
                                    </select>
                                    <input type="text" class="p-1" :name="'columns-name-' + i" id="columns-name">
                            </div>
                        </template>
                        <div class="items-start">
                            <button type="button" @click="rows++" class="p-1 px-3 bg-zinc-700">Add column</button>
                            <button type="button" @click="rows > 1 && rows--" class="p-1 px-3 bg-zinc-700">Remove column</button>
                        </div>
                        <button type="submit" class="p-2 bg-slate-500 text-white">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
