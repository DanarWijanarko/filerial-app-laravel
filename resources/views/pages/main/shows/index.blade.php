@section('title')
    {{ __('Shows') }}
@endsection

<x-main-layout>
    <section class="flex gap-5 pt-10">
        {{-- Results --}}
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

        {{-- All Filters --}}
        <form action="{{ route('shows.filter') }}" method="POST" class="flex w-[20%] flex-col gap-3.5">
            @csrf

            {{-- Sort By --}}
            <div class="flex h-fit w-full flex-col rounded-lg bg-gray-800 py-3" x-data="{ expanded: true }" x-cloak>
                {{-- Expand Button --}}
                <button x-on:click="event.preventDefault(); expanded = ! expanded"
                    class="flex flex-row items-center justify-between pl-5 pr-3 text-xl font-bold transition-all hover:text-gray-300">
                    Sorting
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
                <div x-show="expanded" x-colllapse class="mt-2.5 flex w-full flex-col border-t border-gray-700 py-1.5">
                    <div x-data="{
                        radioGroupSelectedValue: 'alpine',
                        radioGroupOptions: [{
                                title: 'Tailwind CSS',
                                description: 'A utility-first CSS framework for rapid UI development.',
                                value: 'tailwind'
                            },
                            {
                                title: 'Alpine JS',
                                description: 'A rugged and lightweight JavaScript framework.',
                                value: 'alpine'
                            },
                            {
                                title: 'Laravel',
                                description: 'The PHP Framework for Web Artisans.',
                                value: 'laravel'
                            }
                        ]
                    }" class="space-y-3 px-5">
                        <template x-for="(option, index) in radioGroupOptions" :key="index">
                            <label @click="radioGroupSelectedValue = option.value"
                                class="flex items-start space-x-3 rounded-md bg-gray-700 p-3.5 text-white hover:bg-gray-600">
                                <input type="radio" name="sort_by" :checked="option.value == radioGroupSelectedValue"
                                    :value="option.value" class="translate-y-px text-gray-900 focus:ring-gray-700" />
                                <span class="relative flex flex-col space-y-1.5 text-left leading-none">
                                    <span x-text="option.title" class="font-semibold"></span>
                                    <span x-text="option.description" class="text-sm opacity-50"></span>
                                </span>
                            </label>
                        </template>
                    </div>
                </div>
            </div>

            {{-- Where to Watch --}}
            <div class="flex h-fit w-full flex-col rounded-lg bg-gray-800 py-3" x-data="{ expanded: false }" x-cloak>
                {{-- Expand Button --}}
                <button x-on:click="event.preventDefault(); expanded = ! expanded"
                    class="flex flex-row items-center justify-between pl-5 pr-3 text-xl font-bold transition-all hover:text-gray-300">
                    Where to Watch
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
                <div x-show="expanded" x-colllapse x-data="watchProviders({{ json_encode($allAvailableCountry) }}, '{{ config('tmdb.apiKey') }}', [{{ $selectedWatchProviders ?? '' }}])" class="mt-2.5 flex w-full flex-col border-t border-gray-700 pb-1.5 pt-2.5">
                    <input type="hidden" name="watch_region" :value="value">
                    <input type="hidden" name="provider_ids" :value="provider_ids">

                    {{-- Available Country --}}
                    <div class="relative flex flex-col gap-2 px-5">
                        {{-- Label --}}
                        <h1 class="text-sm font-bold">Country</h1>

                        {{-- Button Dropdown --}}
                        <button x-ref="buttonDropdown" @click.prevent="isOpen = ! isOpen"
                            class="flex flex-row justify-between rounded-lg bg-gray-700 px-3.5 py-1.5 text-sm">
                            <span x-text="value"></span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M6 9l6 6l6 -6" />
                            </svg>
                        </button>

                        {{-- Dropdown Menu --}}
                        <div x-show="isOpen" @click.outside="isOpen = false" x-anchor.bottom.offset.5="$refs.buttonDropdown" x-transition
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
                                <button x-show="search === ''" @click.prevent="value = 'None Selected'; isOpen = false"
                                    class="w-full px-5 py-1.5 text-start hover:bg-gray-600" :class="value === 'None Selected' ? 'bg-blue-500' : ''">
                                    None Selected
                                </button>
                                <template x-for="country in countries">
                                    <button x-show="country.english_name.toLowerCase().includes(search.toLowerCase())" @click.prevent="fetchData(country)"
                                        class="w-full px-5 py-1.5 text-start hover:bg-gray-600" :class="value === country.english_name ? 'bg-blue-500' : ''">
                                        <span x-text="country.english_name"></span>
                                    </button>
                                </template>
                            </section>
                        </div>
                    </div>

                    {{-- List Watch Providers --}}
                    <div class="flex flex-wrap items-center gap-3 px-5 pt-4">
                        <template x-for="provider in providers">
                            <button class="relative w-[4.35rem] transition-all hover:opacity-80"
                                x-on:click="event.preventDefault(); provider_ids.includes(provider.provider_id) ? (provider_ids.indexOf(provider.provider_id) !== -1 ? provider_ids.splice(provider_ids.indexOf(provider.provider_id), 1) : null) : provider_ids.push(provider.provider_id);">
                                <x-tooltip x-data="{
                                    tooltipVisible: false,
                                    tooltipText: provider.provider_name,
                                    tooltipArrow: true,
                                    tooltipPosition: 'top',
                                }">
                                    <img :src="'{{ config('tmdb.baseImgUrl') }}' + provider.logo_path" class="rounded-lg">
                                </x-tooltip>
                                <span x-show="provider_ids.includes(provider.provider_id)"
                                    class="absolute left-0 top-0 z-20 flex h-full w-full items-center justify-center rounded-lg bg-blue-500 bg-opacity-80">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"
                                        stroke-linecap="round" stroke-linejoin="round" class="h-7 w-7 text-white">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M5 12l5 5l10 -10" />
                                    </svg>
                                </span>
                            </button>
                        </template>
                    </div>
                </div>
            </div>

            {{-- Filters Menu --}}
            <div class="flex h-fit w-full flex-col rounded-lg bg-gray-800 py-3" x-data="{ expanded: true }" x-cloak>
                {{-- Expand Button --}}
                <button x-on:click="event.preventDefault(); expanded = ! expanded"
                    class="flex flex-row items-center justify-between pl-5 pr-3 text-xl font-bold transition-all hover:text-gray-300">
                    Filters
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"
                        stroke-linecap="round" stroke-linejoin="round" class="h-7 w-7" x-show="expanded === false">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M9 6l6 6l-6 6" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"
                        stroke-linecap="round" stroke-linejoin="round" class="h-7 w-7" x-show="expanded === true">
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

                    <span class="mb-3 mt-4 h-[1px] w-full bg-gray-700"></span>

                    {{-- Languages --}}
                    <x-default-search-input :datas="$allLanguages" :value="$selectedLanguange ?? 'Korean'" name="original_language" label="Language">
                        <template x-for="lang in datas">
                            <button x-show="lang.english_name.toLowerCase().includes(search.toLowerCase())"
                                @click="value = lang.english_name; isOpen = false; event.preventDefault()"
                                class="w-full px-5 py-1.5 text-start hover:bg-gray-600" :class="value === lang.english_name ? 'bg-blue-500' : ''">
                                <span x-text="lang.english_name"></span>
                            </button>
                        </template>
                    </x-default-search-input>

                    <span class="mb-3 mt-4 h-[1px] w-full bg-gray-700"></span>

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
                            class="z-50 flex h-56 w-[87%] flex-col items-start rounded-lg bg-gray-700 text-sm">

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
                                <template x-for="network in networks">
                                    <button x-show="network.name?.toLowerCase().includes(search.toLowerCase())"
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

                    <span class="mb-3 mt-4 h-[1px] w-full bg-gray-700"></span>

                    {{-- First Air Date Year --}}
                    <div class="relative flex flex-col gap-2 px-5" x-data="range('{{ $selectedFirstAirDateYear ?? null }}', '{{ \Carbon\Carbon::now()->year - 30 }}', '{{ \Carbon\Carbon::now()->year }}')">
                        {{-- Label --}}
                        <h1 class="text-sm font-bold">First Air Date Year</h1>

                        <div class="relative">
                            <input type="hidden" name="first_air_date_year" :value="yearValue">
                            <input type="range" x-model="yearValue" :min="min" :max="max" x-on:input="bubbles"
                                class="default-range peer w-full">
                            <span x-ref="bubblesText" x-text="yearValue"
                                class="absolute -top-7 hidden rounded-md bg-blue-500 px-2 py-1 text-sm peer-active:block peer-active:-translate-x-1/2"></span>
                            <div class="-mx-1.5 -mt-0.5 flex flex-row justify-between text-xs text-gray-400">
                                <span x-text="min"></span>
                                <span x-text="max"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Submit Button --}}
            <button type="submit" class="rounded-lg bg-blue-500 px-3 py-2 font-bold tracking-wider transition-all hover:bg-blue-600 active:scale-95">
                Search
            </button>
        </form>
    </section>
</x-main-layout>
