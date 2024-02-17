<header class="menu p-3 mb-3 flex flex-row w-full gap-4">
    <div>
        <a href="#" class="hover:text-zinc-400">API Builder</a>
    </div>
    <div class="gap-2">
            <a class="p-1" href="/">Home</a>
            <a class="p-1" href="/create">Create</a>
    </div>
    <div class="flex gap-2 ml-auto">
    @guest
        <button onclick="login_modal.showModal();" class="hover:text-zinc-400" href="#">Login <i class="fa-solid fa-right-to-bracket"></i></button>
        <span class="ml-2">or</span>
        <button onclick="signup_modal.showModal();" class="hover:text-zinc-400 ml-2" href="#">Sign Up <i class="fa-solid fa-user-plus"></i></button>
    @else
        <form action="{{ route('logout') }}" method="POST" class="my-0">
            @csrf
            <button onclick="signup_modal.showModal();" class="hover:text-zinc-400" href="#" type="submit">Log Out <i class="fa-solid fa-right-from-bracket"></i></button>
        </form>
    @endguest
    </div>
</header>
