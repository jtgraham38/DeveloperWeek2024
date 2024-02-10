<dialog id="{{ $id }}" class="py-6 px-3 border border-zinc-200 card relative">
    {{$slot}}

    <button onclick="{{ $id }}.close();" class="absolute top-0 right-0 mt-2 mr-2 hover:text-zinc-400">
        <i class="fa-solid fa-sm fa-x"></i>
    </button>
</dialog>