@extends("layouts.main")
@section("template")
<div class="bg-gray-800">

  
    <div class="relative isolate px-6 pt-14 lg:px-8 mt-6">
        <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" aria-hidden="true" style="pointer-events: none;">
            <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#fbbf25] to-[#c2410c] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
        </div>
        <div class="mx-auto max-w-2xl py-32 sm:py-48 lg:py-56">
            <div class="hidden sm:mb-8 sm:flex sm:justify-center">
            {{-- <div class="relative rounded-full px-3 py-1 text-sm leading-6 text-zinc-200 ring-1 ring-zinc-800/10 hover:ring-zinc-500/20">
                Announcing new REST API Generation. <a href="#" class="font-semibold text-amber-600"><span class="absolute inset-0" aria-hidden="true"></span>Read more <span aria-hidden="true">&rarr;</span></a>
            </div> --}}
            </div>
            <div class="text-center">
            <h1 class="text-4xl font-bold tracking-tight text-zinc-200 sm:text-6xl">APIs Made Easy</h1>
            <p class="mt-6 text-lg leading-8 text-zinc-200">Our suite of tools makes it easy for you to generate an API allowing apps to interact with your database.</p>
            <div class="mt-10 flex items-center justify-center gap-x-6">
                @guest
                    <button onclick="signup_modal.showModal();" class="primary_btn rounded-md px-4 py-3 text-sm font-semibold focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-800">
                        <h4>Get Started <i class="fa-solid fa-user-plus"></i></h4>
                    </button>

                    <button onclick="login_modal.showModal();" class="secondary_btn text-sm font-semibold leading-6">
                        <h4>Sign In <i class="fa-solid fa-right-to-bracket"></i></h4>
                    </button>
                @else
                    <a href="{{ route('projects.none_selected') }}" class="primary_btn rounded-md px-4 py-3 text-sm font-semibold focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-800">
                        <h4>Go to Dashboard <i class="fa-solid fa-dashboard"></i></h4>
                    </a>
                @endif
                
            </div>
            </div>
        </div>
        <div class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]" aria-hidden="true" style="pointer-events: none;">
            <div class="relative left-[calc(50%+3rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 bg-gradient-to-tr from-[#fbbf25] to-[#c2410c] opacity-30 sm:left-[calc(50%+36rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
        </div>
    </div>
</div>

<div class="flex flex:col md:flex-row justify-evenly w-full my-4">
    <div class="card p-4 w-1/4 rounded-lg">
        <h3>Step 1: Sign Up With Us</h3>
        <hr>
        <div class="p-4 flex flex-col justify-center items-center">
            <i class="fa-solid fa-user-plus fa-10x"></i>
            <p class="p-2 text-lg">Sign up for an account with our unique api creation platform.</p>
        </div>
    </div>

    <div class="card p-4 w-1/4 rounded-lg">
        <h3>Step 2: Enter Database Info</h3>
        <hr>
        <div class="p-2 flex flex-col justify-center items-center">
            <i class="fa-solid fa-keyboard fa-10x"></i>
            <p class="p-2 text-lg">Use our project editor to enter information about your database and data structure.</p>
        </div>
    </div>

    <div class="card p-4 w-1/4 rounded-lg">
        <h3>Step 3: Download New API</h3>
        <hr>
        <div class="p-2 flex flex-col justify-center items-center">
            <i class="fa-solid fa-file-arrow-down fa-10x"></i>
            <p class="p-2 text-lg">Download your new api, and follow the included instructions to activate your new api.</p>
        </div>
    </div>
</div>

<footer class="bg-gray-800 p-6">
    <div class="flex justify-between">
        <div>( ͡ʘ ͜ʖ ͡ʘ)</div>
        <div>
            Sunrise API Builder
        </div>
        <div>A project by <a class="text-amber-600 hover:text-amber-700" href="https://jacob-t-graham.com">Jacob Graham</a> and Daniel Ellingson.</div>
    </div>
</footer>
  
@endsection
