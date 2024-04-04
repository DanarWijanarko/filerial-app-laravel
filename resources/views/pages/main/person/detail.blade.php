@inject('url', 'App\Services\TmdbService')

@section('title')
    {{ $detail->name }}
@endsection

<x-main-layout>
    {{-- Details Section --}}
    <section class="mt-11 flex flex-row items-center justify-center gap-6">
        {{-- Section Poster Image --}}
        <img src="{{ $detail->profile }}" alt="{{ $detail->name }}" class="w-96 rounded-md">

        {{-- Section Contents --}}
        <div class="bg--400 flex max-h-[576px] w-[500px] flex-col justify-center gap-1 py-3.5" x-data="{ isVideoPlayerOpen: false }">
            {{-- Name --}}
            <h1 class="mb-1.5 text-5xl font-bold">{{ $detail->name }}</h1>

            {{-- Also known as --}}
            <div class="flex flex-row flex-wrap gap-0.5 font-medium">
                <h1 class="font-bold text-gray-500">Also Known as:&nbsp;</h1>
                @foreach ($detail->also_known_as as $index => $name)
                    <p class="font-medium text-gray-400">
                        {{ $name }}
                    </p>
                    @if ($index < count($detail->also_known_as) - 1)
                        <p class="font-bold text-gray-300">,&nbsp;</p>
                    @endif
                @endforeach
            </div>

            {{-- Place of Birth --}}
            <div class="flex flex-row items-center gap-2">
                <p class="font-bold text-gray-500">Place of Birth:</p>
                <p class="font-medium text-gray-400">{{ $detail->place_of_birth }}</p>
            </div>

            {{-- Born - Death --}}
            <div class="flex flex-row items-center gap-2">
                <p class="font-bold text-gray-500">Born:</p>
                <p class="font-medium text-gray-400">
                    {{ $detail->birthday }}
                </p>
                @if ($detail->deathday)
                    <span class="h-0.5 w-2 rounded-full bg-gray-600"></span>
                    <p class="font-bold text-gray-500">Death:</p>
                    <p class="font-medium text-gray-400">
                        {{ $detail->birthday }}
                    </p>
                @endif
            </div>

            {{-- Age --}}
            <div class="flex flex-row gap-2">
                <p class="font-bold text-gray-500">Age:</p>
                <p class="font-medium text-gray-400">{{ $detail->age }}</p>
            </div>

            {{-- Gender --}}
            <div class="flex flex-row gap-2">
                <p class="font-bold text-gray-500">Gender:</p>
                <p class="font-medium text-gray-400">{{ $detail->gender }}</p>
            </div>

            {{-- Popularity --}}
            <div class="flex flex-row gap-2">
                <p class="font-bold text-gray-500">Popularity:</p>
                <p class="font-medium text-gray-400">{{ $detail->popularity }}</p>
            </div>

            {{-- Department --}}
            <div class="flex flex-row gap-2">
                <p class="font-bold text-gray-500">Department:</p>
                <p class="font-medium text-gray-400">{{ $detail->known_for_department }}</p>
            </div>

            {{-- Biography --}}
            <div class="w-[475px] overflow-auto pr-1">
                <p class="text-justify font-medium text-gray-400">
                    <span class="font-bold text-gray-500">Biography:&nbsp;</span>
                    {{ $detail->biography }}
                </p>
            </div>

            {{-- Buttons --}}
            <div class="mt-1.5 flex flex-row gap-5">
                {{-- Add to Collection --}}
                <button class="flex flex-row items-center gap-2 rounded-md bg-blue-600 px-3 py-2 font-bold transition-all hover:bg-blue-700 active:scale-95">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="h-7 w-7">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M3 4m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" />
                        <path d="M5 8v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-10" />
                        <path d="M10 12l4 0" />
                    </svg>
                    Add to Collection
                </button>
            </div>
        </div>
    </section>

    <span class="mb-7 mt-11 flex h-0.5 w-full rounded-full bg-gray-800"></span>

    {{-- Credits Section --}}
    <section class="w-full px-5">
        {{-- Section Title --}}
        <h1 class="mb-3 text-3xl font-bold">Credits</h1>

        {{-- Credits Menu --}}
        <div class="flex flex-row items-center justify-between" x-data="{ trigBtn: null }">
            {{-- Menu Buttons --}}
            <div class="flex flex-row gap-1.5">
                <a href="{{ $url->customUrl('tv_credits') }}"
                    @click="window.sessionStorage.setItem('scrollPosition', window.pageYOffset || document.documentElement.scrollTop)"
                    class="rounded-lg bg-blue-600 px-4 py-2 font-bold transition-all hover:bg-blue-700">
                    Tv Shows
                </a>
                <a href="{{ $url->customUrl('movie_credits') }}"
                    @click="window.sessionStorage.setItem('scrollPosition', window.pageYOffset || document.documentElement.scrollTop)"
                    class="rounded-lg bg-blue-600 px-4 py-2 font-bold transition-all hover:bg-blue-700">
                    Movies
                </a>
            </div>

            {{-- Pagination Information --}}
            <h2 class="text-sm text-gray-500">
                Showing <span class="font-semibold text-blue-500">
                    {{ ($credits->pagination->current_page - 1) * $credits->pagination->per_page + 1 }}
                </span>
                to <span class="font-semibold text-blue-500">
                    {{ min($credits->pagination->current_page * $credits->pagination->per_page, $credits->pagination->total) }}
                </span>
                of <span class="font-semibold text-blue-500">
                    {{ $credits->pagination->total }}
                </span>
            </h2>

            {{-- Pagination Buttons --}}
            <div class="flex flex-row">
                <a href="{{ request()->fullUrlWithQuery(['credit_page' => $credits->pagination->current_page - 1]) }}"
                    @click="window.sessionStorage.setItem('scrollPosition', window.pageYOffset || document.documentElement.scrollTop)"
                    class="{{ $credits->pagination->current_page > 1 ? 'bg-blue-700' : 'pointer-events-none bg-blue-600' }} rounded-l-lg border-y border-l border-blue-600 p-1.5">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round"
                        stroke-linejoin="round" class="h-5 w-5">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M15 6l-6 6l6 6" />
                    </svg>
                </a>
                <a href="{{ request()->fullUrlWithQuery(['credit_page' => $credits->pagination->current_page + 1]) }}"
                    @click="window.sessionStorage.setItem('scrollPosition', window.pageYOffset || document.documentElement.scrollTop)"
                    class="{{ $credits->pagination->current_page < $credits->pagination->last_page ? 'bg-blue-700' : 'pointer-events-none bg-blue-600' }} rounded-r-lg border border-blue-600 p-1.5">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round"
                        stroke-linejoin="round" class="h-5 w-5">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M9 6l6 6l-6 6" />
                    </svg>
                </a>
            </div>
        </div>

        {{-- Section Contents --}}
        <div class="mt-4 grid grid-cols-5 gap-3">
            @foreach ($credits->results as $credit)
                <a href="{{ route($credit->mediaType . '.detail', ['name' => $credit->slug, 'id' => $credit->id]) }}" class="group relative">
                    @if ($credit->poster !== null)
                        <img src="{{ $credit->poster }}" alt="{{ $credit->name }}" class="h-full w-full rounded-lg">
                    @else
                        <div class="flex h-[450px] w-full items-center justify-center rounded-lg bg-gray-800 text-3xl font-bold">No Image</div>
                    @endif
                    <div
                        class="absolute left-0 top-0 h-full w-full overflow-hidden rounded-lg bg-gray-800 opacity-0 transition-all duration-300 group-hover:opacity-100">
                        <img src="{{ $credit->backdrop }}" alt="{{ $credit->name }}" class="h-1/2 w-full rounded-t-lg object-cover">
                        <div class="flex flex-col gap-2 px-4 py-3">
                            <h1 class="text-nowrap overflow-clip overflow-ellipsis text-3xl font-bold">{{ $credit->name }}</h1>
                            <div class="flex w-full flex-row items-center gap-4 font-medium text-gray-300">
                                <p>{{ $credit->release_date }}</p>
                                <span class="h-2 w-2 rounded-full bg-gray-600"></span>
                                <p>{{ $credit->origin_country }}</p>
                                <span class="h-2 w-2 rounded-full bg-gray-600"></span>
                                <p>{{ $credit->vote_average }}</p>
                            </div>
                            <p class="h-36 overflow-clip overflow-ellipsis text-xl">{{ $credit->overview }}</p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    <span class="mb-7 mt-11 flex h-0.5 w-full rounded-full bg-gray-800"></span>

    {{-- Gallery Section --}}
    <section class="w-full px-5">
        {{-- Section Title & Pagination --}}
        <div class="mb-3 flex flex-row items-center justify-between">
            {{-- Title --}}
            <h1 class="text-3xl font-bold">Gallery</h1>

            {{-- Pagination Information --}}
            <h2 class="text-sm text-gray-500">
                Showing <span class="font-semibold text-blue-500">
                    {{ ($images->pagination->current_page - 1) * $images->pagination->per_page + 1 }}
                </span>
                to <span class="font-semibold text-blue-500">
                    {{ min($images->pagination->current_page * $images->pagination->per_page, $images->pagination->total) }}
                </span>
                of <span class="font-semibold text-blue-500">
                    {{ $images->pagination->total }}
                </span>
            </h2>

            {{-- Pagination Buttons --}}
            <div class="flex flex-row" x-data="{ trigBtn: null }">
                <a href="{{ request()->fullUrlWithQuery(['gallery_page' => $images->pagination->current_page - 1]) }}"
                    @click="window.sessionStorage.setItem('scrollPosition', window.pageYOffset || document.documentElement.scrollTop); console.log('ww')"
                    class="{{ $images->pagination->current_page > 1 ? 'bg-gray-700' : 'pointer-events-none bg-gray-600' }} rounded-l-lg border-y border-l border-gray-600 p-1.5">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4"
                        stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M15 6l-6 6l6 6" />
                    </svg>
                </a>
                <a href="{{ request()->fullUrlWithQuery(['gallery_page' => $images->pagination->current_page + 1]) }}"
                    @click="window.sessionStorage.setItem('scrollPosition', window.pageYOffset || document.documentElement.scrollTop)"
                    class="{{ $images->pagination->current_page < $images->pagination->last_page ? 'bg-gray-700' : 'pointer-events-none bg-gray-600' }} rounded-r-lg border border-gray-600 p-1.5">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4"
                        stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M9 6l6 6l-6 6" />
                    </svg>
                </a>
            </div>
        </div>

        {{-- Section Contents --}}
        <div x-data="{ showModal: false, imgModal: null }" class="grid grid-cols-5 gap-3">
            {{-- Images --}}
            @foreach ($images->results as $img)
                <div class="group relative cursor-pointer" @click="showModal = true ; imgModal = '{{ $img }}'">
                    <img src="{{ $img }}" alt="gallery" class="h-auto max-w-full rounded-lg border border-gray-700">
                    <span class="absolute left-0 top-0 h-full w-full rounded-lg transition-all group-hover:bg-black/20"></span>
                </div>
            @endforeach

            {{-- Show Images Modal --}}
            <div x-show="showModal" class="fixed inset-0 z-50 flex items-center justify-center">
                <img :src="imgModal" alt="modal Image" @click.outside="showModal = false" class="z-50 h-[80%] rounded-lg">
                <div class="fixed inset-0 bg-black/80"></div>
            </div>
        </div>
    </section>
</x-main-layout>
