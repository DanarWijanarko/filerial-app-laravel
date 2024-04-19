@section('title')
    {{ __('Shows') }}
@endsection

<x-main-layout>
    {{-- Navigation --}}
    <section class="flex items-center justify-between border-b border-gray-700 pb-3 pt-5">
        {{-- Buttons Navigate --}}
        <div class="flex flex-row gap-1.5">
            <a href="{{ route('shows.index', ['type' => 'popular']) }}"
                class="rounded-md bg-purple-600 px-3 py-1 text-sm font-bold transition-all hover:bg-purple-700 active:scale-95">
                Popular
            </a>
            <a href="{{ route('shows.index', ['type' => 'top_rated']) }}"
                class="rounded-md bg-purple-600 px-3 py-1 text-sm font-bold transition-all hover:bg-purple-700 active:scale-95">
                Top Rated
            </a>
            <a href="{{ route('shows.index', ['type' => 'on_the_air']) }}"
                class="rounded-md bg-purple-600 px-3 py-1 text-sm font-bold transition-all hover:bg-purple-700 active:scale-95">
                On The Air
            </a>
            <a href="{{ route('shows.index', ['type' => 'airing_today']) }}"
                class="rounded-md bg-purple-600 px-3 py-1 text-sm font-bold transition-all hover:bg-purple-700 active:scale-95">
                Airing Today
            </a>
        </div>

        {{-- Button Sorting --}}
        <div class="relative" x-data="{ isOpen: false }">
            <button class="flex flex-row items-center justify-center gap-2 text-sm" @click="isOpen = ! isOpen">
                Sort
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"
                    stroke-linejoin="round" class="h-4 w-4">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M6 9l6 6l6 -6" />
                </svg>
            </button>
            <div x-show="isOpen" @click.outside="isOpen = false" x-transition.scale.origin.top.right
                class="absolute right-0 top-7 z-50 flex w-32 flex-col overflow-hidden rounded-lg border border-gray-600 bg-gray-700 py-1 text-sm text-gray-400">
                <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'popularity.desc']) }}" @class([
                    'px-4 py-1 hover:bg-gray-800',
                    'text-white font-bold' => true,
                ])>
                    Most Popular
                </a>
                <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'vote_average.desc']) }}" class="px-4 py-1 hover:bg-gray-800">
                    Best Rating
                </a>
                <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'first_air_date.desc']) }}" class="px-4 py-1 hover:bg-gray-800">
                    Newest
                </a>
                <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'name.desc']) }}" class="px-4 py-1 hover:bg-gray-800">
                    Name (A - Z)
                </a>
                <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'name.asc']) }}" class="px-4 py-1 hover:bg-gray-800">
                    Name (Z - A)
                </a>
            </div>
        </div>
    </section>

    {{-- Body --}}
    <section class="flex gap-5 pt-5">
        {{-- Left Section --}}
        <div class="w-[80%]">
            <div class="grid grid-cols-5 gap-2">
                @foreach ($results as $item)
                    <a href="{{ route($item->mediaType . '.detail', ['name' => $item->slug, 'id' => $item->id]) }}" class="group relative h-full">
                        @if ($item->poster !== null)
                            <img src="{{ $item->poster }}" alt="{{ $item->name }}" class="h-full w-full rounded-lg object-cover">
                        @else
                            <div class="flex h-[450px] w-full items-center justify-center rounded-lg bg-gray-800 text-3xl font-bold">No Image</div>
                        @endif
                        <div
                            class="absolute left-0 top-0 h-full w-full overflow-hidden rounded-lg bg-gray-800 opacity-0 transition-all duration-300 group-hover:opacity-100">
                            <img src="{{ $item->backdrop }}" alt="{{ $item->name }}" class="h-1/2 w-full rounded-t-lg object-cover">
                            <div class="flex flex-col gap-2 overflow-hidden px-4 py-3">
                                <h1 class="text-nowrap overflow-clip overflow-ellipsis text-3xl font-bold">{{ $item->name }}</h1>
                                <div class="flex w-full flex-row items-center gap-4 font-medium text-gray-300">
                                    <p>{{ $item->release_date }}</p>
                                    <span class="h-2 w-2 rounded-full bg-gray-600"></span>
                                    <p>{{ $item->origin_country }}</p>
                                    <span class="h-2 w-2 rounded-full bg-gray-600"></span>
                                    <p>{{ $item->vote_average }}</p>
                                </div>
                                <p class="line-clamp-4 text-xl">{{ $item->overview }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

        {{-- Right Section --}}
        <form action="{{ route('shows.filter') }}" method="POST" class="flex w-[20%] flex-col gap-3.5">
            @csrf

            {{-- Submit Button --}}
            <button type="submit" class="rounded-lg bg-blue-500 px-3 py-2 font-bold tracking-wider transition-all hover:bg-blue-600 active:scale-95">
                Search
            </button>

            {{-- ! Watch Providers --}}
            <div class="flex h-fit w-full flex-col rounded-lg bg-gray-800 py-3">

            </div>

            {{-- Filters Menu --}}
            <div class="flex h-fit w-full flex-col rounded-lg bg-gray-800 py-3" x-data="{ expanded: true }">
                {{-- Expand Button --}}
                <button x-on:click="event.preventDefault(); expanded = ! expanded"
                    class="flex flex-row items-center justify-between pl-5 pr-3 text-xl font-bold transition-all hover:text-gray-300">
                    Filters
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"
                        stroke-linejoin="round" class="h-7 w-7" x-show="expanded === false">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M9 6l6 6l-6 6" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"
                        stroke-linejoin="round" class="h-7 w-7" x-show="expanded === true">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M6 9l6 6l6 -6" />
                    </svg>
                </button>

                {{-- Expand Content --}}
                <div x-show="expanded" x-colllapse class="mt-2.5 flex w-full flex-col border-t border-gray-700 pb-1.5 pt-2.5">
                    {{-- Genres --}}
                    <div class="relative flex flex-col gap-2 px-5" x-data="{ values: [{{ $selectedGenres ?? '' }}], genres: {{ json_encode($allGenres) }} }">
                        <input type="hidden" name="genres" :value="values">

                        {{-- Label --}}
                        <h1 class="text-sm font-bold">Genres</h1>

                        {{-- List Genres --}}
                        <div class="flex flex-wrap gap-2">
                            <template x-for="genre in genres">
                                <button
                                    x-on:click="event.preventDefault(); values.includes(genre.id) ? (values.indexOf(genre.id) !== -1 ? values.splice(values.indexOf(genre.id), 1) : null) : values.push(genre.id);"
                                    class="rounded-full px-2 py-1 text-sm font-medium transition-all hover:bg-blue-500"
                                    :class="values.includes(genre.id) ? 'bg-blue-500' : 'bg-gray-700'">
                                    <span x-text="genre.name"></span>
                                </button>
                            </template>
                        </div>
                    </div>

                    <span class="mb-2 mt-3 h-[1px] w-full bg-gray-700"></span>

                    {{-- Languages --}}
                    <div class="relative flex flex-col gap-2 px-5" x-data="{ isOpen: false, value: '{{ $selectedLanguange ?? 'Korean' }}', languages: {{ json_encode($allLanguages) }}, search: '' }">
                        <input type="hidden" name="original_language" :value="value">

                        {{-- Label --}}
                        <h1 class="text-sm font-bold">Language</h1>

                        {{-- Button Dropdown --}}
                        <button x-ref="buttonDropdown" @click.prevent="$dispatch('open-dropdown')"
                            class="flex flex-row justify-between rounded-lg bg-gray-700 px-3.5 py-1.5 text-sm">
                            <span x-text="value"></span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M6 9l6 6l6 -6" />
                            </svg>
                        </button>

                        {{-- Dropdown Menu --}}
                        <div x-show="isOpen" @open-dropdown.window="isOpen = ! isOpen" @close-dropdown.window="isOpen = false"
                            @click.outside="$dispatch('close-dropdown')" x-anchor.bottom.offset.5="$refs.buttonDropdown" x-transition
                            class="z-50 flex h-56 w-[87%] flex-col items-start rounded-lg bg-gray-700 text-sm">

                            {{-- Input Searching Language --}}
                            <div class="relative w-full p-3">
                                <input type="text" x-model="search"
                                    class="peer w-full rounded-lg border border-gray-600 bg-gray-700 px-3 py-2 text-xs text-white placeholder-gray-500 focus:border-blue-500 focus:ring-blue-500">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="absolute right-5 top-1/2 h-5 w-5 -translate-y-1/2 peer-focus:text-blue-500">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                    <path d="M21 21l-6 -6" />
                                </svg>
                            </div>

                            {{-- List Language --}}
                            <section class="flex w-full flex-col items-start overflow-y-auto">
                                <button x-show="search === ''" @click.prevent="value = 'None Selected'; $dispatch('close-dropdown')"
                                    class="w-full px-5 py-1.5 text-start hover:bg-gray-600" :class="value === 'None Selected' ? 'bg-blue-500' : ''">
                                    None Selected
                                </button>
                                <template x-for="lang in languages">
                                    <button x-show="lang.english_name.toLowerCase().includes(search.toLowerCase())"
                                        @click="value = lang.english_name; $dispatch('close-dropdown'); event.preventDefault()"
                                        class="w-full px-5 py-1.5 text-start hover:bg-gray-600" :class="value === lang.english_name ? 'bg-blue-500' : ''">
                                        <span x-text="lang.english_name"></span>
                                    </button>
                                </template>
                            </section>
                        </div>
                    </div>

                    <span class="mb-2 mt-3 h-[1px] w-full bg-gray-700"></span>

                    {{-- Networks --}}
                    <div class="relative flex flex-col gap-2 px-5" x-data="{ isOpen: false, value: '{{ $selectedNetwork ?? 'Filter by Show Networks' }}', networks: {{ json_encode($allNetworks) }}, search: '' }">
                        <input type="hidden" name="network" :value="value">

                        {{-- Label --}}
                        <h1 class="text-sm font-bold">Network</h1>

                        {{-- Button Dropdown --}}
                        <button x-ref="buttonDropdownNetwork" @click.prevent="$dispatch('open-dropdown-network')"
                            class="flex flex-row justify-between rounded-lg bg-gray-700 px-3.5 py-1.5 text-sm">
                            <span x-text="value"></span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M6 9l6 6l6 -6" />
                            </svg>
                        </button>

                        {{-- Dropdown Menu --}}
                        <div x-show="isOpen" @open-dropdown-network.window="isOpen = ! isOpen" @close-dropdown-network.window="isOpen = false"
                            @click.outside="$dispatch('close-dropdown-network')" x-anchor.bottom.offset.5="$refs.buttonDropdownNetwork" x-transition
                            class="flex h-56 w-[87%] flex-col items-start rounded-lg bg-gray-700 text-sm">

                            {{-- Input Searching Network --}}
                            <div class="relative w-full p-3">
                                <input type="text" x-model="search"
                                    class="peer w-full rounded-lg border border-gray-600 bg-gray-700 px-3 py-2 text-xs text-white placeholder-gray-500 focus:border-blue-500 focus:ring-blue-500">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="absolute right-5 top-1/2 h-5 w-5 -translate-y-1/2 peer-focus:text-blue-500">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                    <path d="M21 21l-6 -6" />
                                </svg>
                            </div>

                            {{-- List Network --}}
                            <section class="flex w-full flex-col items-start overflow-y-auto overflow-x-clip">
                                <button x-show="search === ''" @click.prevent="value = 'None Selected'; $dispatch('close-dropdown-network')"
                                    class="w-full px-5 py-1.5 text-start hover:bg-gray-600" :class="value === 'None Selected' ? 'bg-blue-500' : ''">
                                    None Selected
                                </button>
                                <template x-for="network in networks">
                                    <button x-show="network.name.toLowerCase().includes(search.toLowerCase())"
                                        @click="value = network.name; $dispatch('close-dropdown-network'); event.preventDefault()"
                                        class="flex w-full flex-row justify-between px-5 py-1.5 text-start text-sm hover:bg-gray-600"
                                        :class="value === network.name ? 'bg-blue-500' : ''">
                                        <div>
                                            <span x-text="network.name"></span>
                                            <template x-if="network.origin_country !== ''">
                                                <span x-text="'(' + network.origin_country + ')'"></span>
                                            </template>
                                        </div>
                                        <template x-if="network.logo !== null">
                                            <img :src="'{{ config('tmdb.baseImgUrl') }}' + network.logo" alt="logo" class="h-4">
                                        </template>
                                    </button>
                                </template>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
</x-main-layout>
