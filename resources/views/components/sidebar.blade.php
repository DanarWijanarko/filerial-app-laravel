<nav
    class="group/parent fixed left-0 top-0 z-50 flex min-h-screen w-24 flex-col items-center justify-center from-gray-900 from-50% to-transparent py-8 transition-all hover:w-52 hover:bg-gradient-to-r">
    {{-- Image Logo --}}
    <div class="fixed left-6 top-10">
        <img src="{{ asset('images/filerial.png') }}" alt="logo" class="h-14 w-14">
    </div>

    {{-- Menu --}}
    <div class="fixed left-7 flex flex-col gap-7 font-bold text-gray-400">
        {{-- Profile --}}
        <a href="{{ route('user.index') }}"
            class="group/btn {{ Route::current()->getName() === 'user.index' ? 'text-white' : '' }} relative flex items-center justify-center transition-all">
            <img src="{{ Auth::user()->picture ? asset('storage/' . Auth::user()->picture) : 'http://www.listercarterhomes.com/wp-content/uploads/2013/11/dummy-image-square.jpg' }}"
                class="{{ Route::current()->getName() === 'user.index' ? 'brightness-100' : 'brightness-50' }} flex h-10 w-10 scale-90 items-center justify-center rounded-full object-cover text-3xl transition-all group-hover/btn:scale-100">
            <p
                class="absolute left-0 origin-left scale-90 text-xl opacity-0 transition-all group-hover/parent:left-14 group-hover/btn:scale-100 group-hover/parent:opacity-100">
                Profile</p>
        </a>

        {{-- Search --}}
        <a href="{{ route('search.index') }}"
            class="group/btn {{ Route::current()->getName() === 'search.index' || Route::current()->getName() === 'search.query' ? 'text-white' : '' }} relative flex items-center justify-center transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"
                stroke-linecap="round" stroke-linejoin="round" class="h-7 w-7 scale-90 transition-all group-hover/btn:scale-100">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                <path d="M21 21l-6 -6" />
            </svg>
            <p
                class="absolute left-0 origin-left scale-90 text-xl opacity-0 transition-all group-hover/parent:left-14 group-hover/btn:scale-100 group-hover/parent:opacity-100">
                Search</p>
        </a>

        {{-- Home --}}
        <a href="{{ route('main.home') }}"
            class="group/btn {{ Route::current()->getName() === 'main.home' ? 'text-white' : '' }} relative flex items-center justify-center transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"
                stroke-linecap="round" stroke-linejoin="round" class="h-7 w-7 scale-90 transition-all group-hover/btn:scale-100">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                <path d="M10 12h4v4h-4z" />
            </svg>
            <p
                class="absolute left-0 origin-left scale-90 text-xl opacity-0 transition-all group-hover/parent:left-14 group-hover/btn:scale-100 group-hover/parent:opacity-100">
                Home</p>
        </a>

        {{-- Shows --}}
        <a href="{{ route('shows.index', ['type' => 'popular']) }}"
            class="group/btn {{ Route::current()->getName() === 'shows.index' ? 'text-white' : '' }} relative flex items-center justify-center transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"
                stroke-linecap="round" stroke-linejoin="round" class="h-7 w-7 scale-90 transition-all group-hover/btn:scale-100">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M3 7m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v9a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" />
                <path d="M16 3l-4 4l-4 -4" />
            </svg>
            <p
                class="absolute left-0 origin-left scale-90 text-xl opacity-0 transition-all group-hover/parent:left-14 group-hover/btn:scale-100 group-hover/parent:opacity-100">
                Shows</p>
        </a>

        {{-- Movies --}}
        <a href="{{ route('movies.index') }}"
            class="group/btn {{ Route::current()->getName() === 'movies.index' ? 'text-white' : '' }} relative flex items-center justify-center transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"
                stroke-linecap="round" stroke-linejoin="round" class="h-7 w-7 scale-90 transition-all group-hover/btn:scale-100">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M4 4m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
                <path d="M8 4l0 16" />
                <path d="M16 4l0 16" />
                <path d="M4 8l4 0" />
                <path d="M4 16l4 0" />
                <path d="M4 12l16 0" />
                <path d="M16 8l4 0" />
                <path d="M16 16l4 0" />
            </svg>
            <p
                class="absolute left-0 origin-left scale-90 text-xl opacity-0 transition-all group-hover/parent:left-14 group-hover/btn:scale-100 group-hover/parent:opacity-100">
                Movies</p>
        </a>
    </div>
</nav>
