@section('title')
    {{ $detail->name }}
@endsection

<x-main-layout>
    {{-- Details Section --}}
    <section class="mt-11 flex flex-row items-center justify-center gap-6">
        {{-- Section Poster Image --}}
        <div class="relative">
            <img src="{{ $detail->poster }}" alt="{{ $detail->name }}" class="w-96 rounded-md">
            <p class="absolute left-2 top-2 rounded-md bg-gray-700 px-3 py-1">{{ $detail->status }}</p>
        </div>

        {{-- Section Contents --}}
        <div class="flex min-w-[550px] flex-col gap-1" x-data="{ isVideoPlayerOpen: false }">
            {{-- Name --}}
            <h1 class="mb-1.5 text-5xl font-bold">{{ $detail->name }}</h1>

            {{-- Country, Release Date, Runtime --}}
            <div class="flex w-full flex-row items-center gap-2 font-medium">
                {{-- Origin Country --}}
                <p class="text-xl font-medium text-gray-400">
                    {{ $detail->origin_country }}
                </p>

                <span class="h-2 w-2 rounded-full bg-gray-600"></span>

                {{-- Release Date --}}
                <p class="text-xl font-medium text-gray-400">
                    {{ $detail->release_date }}
                </p>

                <span class="h-2 w-2 rounded-full bg-gray-600"></span>

                {{-- Runtime --}}
                <p class="text-xl font-medium text-gray-400">
                    {{ $detail->runtime }}
                </p>
            </div>

            {{-- Budget - Revenue --}}
            <div class="flex flex-row items-center gap-2">
                <p class="text-lg font-medium text-gray-400">
                    Budget: {{ $detail->budget }}
                </p>
                <span class="h-0.5 w-3 rounded-full bg-gray-600"></span>
                <p class="text-xl font-medium text-gray-400">
                    Revenue: {{ $detail->revenue }}
                </p>
            </div>

            {{-- Original Name, Popularity, Vote Average & Count --}}
            <div class="my-0.5 flex flex-row items-center gap-5 text-gray-400">
                {{-- Original Name --}}
                <span class="relative flex flex-row items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round"
                        stroke-linejoin="round" class="peer/popover h-7 w-7 text-gray-600 transition-all">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path
                            d="M3 19c3.333 -2 5 -4 5 -6c0 -3 -1 -3 -2 -3s-2.032 1.085 -2 3c.034 2.048 1.658 2.877 2.5 4c1.5 2 2.5 2.5 3.5 1c.667 -1 1.167 -1.833 1.5 -2.5c1 2.333 2.333 3.5 4 3.5h2.5" />
                        <path d="M20 17v-12c0 -1.121 -.879 -2 -2 -2s-2 .879 -2 2v12l2 2l2 -2z" />
                        <path d="M16 7h4" />
                    </svg>
                    <p>{{ $detail->original_name }}</p>
                    <span
                        class="absolute -left-10 -top-9 rounded-md bg-gray-800 px-2 py-1 text-base font-bold text-gray-100 opacity-0 transition-all peer-hover/popover:opacity-100">
                        Original Name
                    </span>
                </span>

                {{-- Popularity --}}
                <span class="relative flex flex-row items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round"
                        stroke-linejoin="round" class="peer/popover h-7 w-7 text-gray-600">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path
                            d="M16 18a2 2 0 0 1 2 2a2 2 0 0 1 2 -2a2 2 0 0 1 -2 -2a2 2 0 0 1 -2 2zm0 -12a2 2 0 0 1 2 2a2 2 0 0 1 2 -2a2 2 0 0 1 -2 -2a2 2 0 0 1 -2 2zm-7 12a6 6 0 0 1 6 -6a6 6 0 0 1 -6 -6a6 6 0 0 1 -6 6a6 6 0 0 1 6 6z" />
                    </svg>
                    <p>{{ $detail->popularity }}</p>
                    <span
                        class="absolute -left-[30px] -top-9 rounded-md bg-gray-800 px-2 py-1 text-base font-bold text-gray-100 opacity-0 transition-all peer-hover/popover:opacity-100">
                        Popularity
                    </span>
                </span>

                {{-- Vote Average --}}
                <span class="relative flex flex-row items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round"
                        stroke-linejoin="round" class="peer/popover h-7 w-7 text-gray-600">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" />
                    </svg>
                    <p>{{ $detail->vote_average }}</p>
                    <span
                        class="absolute -left-[40.6px] -right-[30.6px] -top-9 rounded-md bg-gray-800 px-2 py-1 text-base font-bold text-gray-100 opacity-0 transition-all peer-hover/popover:opacity-100">
                        Vote Average
                    </span>
                </span>

                {{-- Vote Count --}}
                <span class="relative flex flex-row items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round"
                        stroke-linejoin="round" class="peer/popover h-7 w-7 text-gray-600">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path
                            d="M17.8 19.817l-2.172 1.138a.392 .392 0 0 1 -.568 -.41l.415 -2.411l-1.757 -1.707a.389 .389 0 0 1 .217 -.665l2.428 -.352l1.086 -2.193a.392 .392 0 0 1 .702 0l1.086 2.193l2.428 .352a.39 .39 0 0 1 .217 .665l-1.757 1.707l.414 2.41a.39 .39 0 0 1 -.567 .411l-2.172 -1.138z" />
                        <path
                            d="M6.2 19.817l-2.172 1.138a.392 .392 0 0 1 -.568 -.41l.415 -2.411l-1.757 -1.707a.389 .389 0 0 1 .217 -.665l2.428 -.352l1.086 -2.193a.392 .392 0 0 1 .702 0l1.086 2.193l2.428 .352a.39 .39 0 0 1 .217 .665l-1.757 1.707l.414 2.41a.39 .39 0 0 1 -.567 .411l-2.172 -1.138z" />
                        <path
                            d="M12 9.817l-2.172 1.138a.392 .392 0 0 1 -.568 -.41l.415 -2.411l-1.757 -1.707a.389 .389 0 0 1 .217 -.665l2.428 -.352l1.086 -2.193a.392 .392 0 0 1 .702 0l1.086 2.193l2.428 .352a.39 .39 0 0 1 .217 .665l-1.757 1.707l.414 2.41a.39 .39 0 0 1 -.567 .411l-2.172 -1.138z" />
                    </svg>
                    <p>{{ $detail->vote_count }}</p>
                    <span
                        class="absolute -left-[33.1px] -right-[13.1px] -top-9 rounded-md bg-gray-800 px-2 py-1 text-base font-bold text-gray-100 opacity-0 transition-all peer-hover/popover:opacity-100">
                        Vote Count
                    </span>
                </span>
            </div>

            {{-- Collection --}}
            <div class="flex flex-row items-center gap-1">
                <p class="font-bold text-gray-600">Collection:</p>
                <a href="{{ route('explore', ['to' => 'collection', 'name' => $detail->belongs_to_collection->name, 'id' => $detail->belongs_to_collection->id, 'media_type' => $detail->mediaType]) }}"
                    class="font-medium text-gray-400 transition-all hover:text-blue-600 hover:underline">
                    {{ $detail->belongs_to_collection->name }}
                </a>
            </div>

            {{-- Genres --}}
            <div class="flex w-full flex-row items-center gap-3 font-medium">
                @foreach ($detail->genres as $index => $genre)
                    <a href="{{ route('explore', ['to' => 'genre', 'name' => $genre->name, 'id' => $genre->id, 'media_type' => $detail->mediaType]) }}"
                        class="text-xl font-medium text-gray-400">
                        {{ $genre->name }}
                    </a>
                    @if ($index < count($detail->genres) - 1)
                        <span class="h-5 w-0.5 rounded-full bg-gray-600"></span>
                    @endif
                @endforeach
            </div>

            {{-- Production Companies --}}
            <div class="mb-1.5 mt-2 flex flex-row gap-3">
                @foreach ($detail->production_companies as $company)
                    <div class="flex flex-col items-center justify-center gap-1 text-sm">
                        <a href="{{ route('explore', ['to' => 'company', 'name' => $company->slug, 'id' => $company->id, 'media_type' => $detail->mediaType]) }}"
                            class="flex h-20 w-20 flex-col items-center justify-center rounded-full bg-white p-2">
                            <img src="{{ $company->logo }}" alt="{{ $company->name }}" class="h-full w-full object-contain">
                        </a>
                        <p class="text-sm font-medium text-gray-300">{{ $company->name }}</p>
                    </div>
                @endforeach
            </div>

            {{-- Overview --}}
            <div class="max-h-[165px] w-[430px]">
                <p class="line-clamp-[7] text-justify font-medium text-gray-400">{{ $detail->overview }}</p>
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

                {{-- Play Trailer --}}
                @if ($detail->videos === null)
                    <button @click="isVideoPlayerOpen = true" disabled x-data="{ onHover: false }" x-on:mouseover="onHover = true" x-on:mouseout="onHover = false"
                        class="relative flex cursor-not-allowed flex-row items-center gap-2 rounded-md bg-blue-600 px-3 py-2 font-bold">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" class="h-7 w-7">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M7 4v16l13 -8z" />
                        </svg>
                        Play Trailer
                        <span x-show="onHover" class="absolute -bottom-10 left-[30px] rounded-md bg-gray-800 px-2 py-1">
                            No Video
                        </span>
                    </button>
                @else
                    <button @click="isVideoPlayerOpen = true"
                        class="flex flex-row items-center gap-2 rounded-md bg-blue-600 px-3 py-2 font-bold transition-all hover:bg-blue-700 active:scale-95">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" class="h-7 w-7">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M7 4v16l13 -8z" />
                        </svg>
                        Play Trailer
                    </button>
                @endif
            </div>

            {{-- Trailer Player --}}
            <div class="fixed left-0 top-0 z-50 flex h-full w-full items-center justify-center bg-black/70" x-show="isVideoPlayerOpen" x-transition>
                <button class="fixed right-5 top-5" @click="isVideoPlayerOpen = false">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="5"
                        stroke-linecap="round" stroke-linejoin="round" class="h-7 w-7 text-gray-400">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M18 6l-12 12" />
                        <path d="M6 6l12 12" />
                    </svg>
                </button>
                <template x-if="isVideoPlayerOpen">
                    <iframe @click.outside="isVideoPlayerOpen = false" src="https://www.youtube.com/embed/{{ $detail->videos->key }}" allowfullscreen
                        class="h-[720px] w-[1280px] border-none" allow="autoplay; encrypted-media"></iframe>
                </template>
            </div>
        </div>
    </section>

    <span class="mb-7 mt-11 flex h-0.5 w-full rounded-full bg-gray-800"></span>

    {{-- Credits Section --}}
    <section class="w-full px-5" x-data="{ mySwiper: false }">
        {{-- Section Title --}}
        <h1 class="mb-3 text-3xl font-bold">Casts</h1>

        {{-- Section Contents --}}
        <div class="relative">
            {{-- Swiper Container --}}
            <swiper-container slides-per-view="6" space-between="7" speed="500" loop="false" css-mode="true" class="w-full" x-ref="mySwiper">
                @foreach ($credits as $credit)
                    <swiper-slide class="flex items-center justify-center">
                        <a href="{{ route('person.detail', ['name' => $credit->slug, 'id' => $credit->id]) }}"
                            class="flex h-full flex-row gap-2 object-cover">
                            <img src="{{ $credit->profile }}" alt="{{ $credit->name }}" class="w-[110px] rounded-lg">
                            <div class="mt-4 overflow-hidden">
                                <h1 class="line-clamp-1 text-xl font-bold">{{ $credit->name }}</h1>
                                <h2 class="line-clamp-1 text-lg font-medium text-gray-400">{{ $credit->character }}</h2>
                                <h2 class="line-clamp-1 font-medium text-gray-500">{{ $credit->gender }}</h2>
                                <h2 class="line-clamp-1 font-medium text-gray-500">{{ $credit->popularity }}</h2>
                            </div>
                        </a>
                    </swiper-slide>
                @endforeach
            </swiper-container>

            {{-- Buttons --}}
            <button @click="$refs.mySwiper.swiper.slidePrev()"
                class="group absolute left-0 top-0 z-30 h-full bg-transparent transition-all duration-300 hover:bg-gradient-to-r hover:from-gray-900 hover:to-transparent">
                <i class='bx bx-chevron-left pr-10 text-4xl text-white transition-all duration-500 group-hover:pl-2'></i>
            </button>
            <button @click="$refs.mySwiper.swiper.slideNext()"
                class="group absolute right-0 top-0 z-30 h-full transition-all duration-500 hover:bg-gradient-to-l hover:from-gray-900 hover:to-transparent">
                <i class='bx bx-chevron-right pl-10 text-4xl text-white transition-all duration-500 group-hover:pr-2'></i>
            </button>
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
                    @click="window.sessionStorage.setItem('scrollPosition', window.pageYOffset || document.documentElement.scrollTop)"
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
                <img :src="imgModal" alt="modal Image" @click.outside="showModal = false" class="z-50 w-1/2 rounded-lg">
                <div class="fixed inset-0 bg-black/80"></div>
            </div>
        </div>
    </section>

    <span class="mb-7 mt-9 flex h-0.5 w-full rounded-full bg-gray-800"></span>

    {{-- Recommendations Section --}}
    <section class="w-full px-5">
        <x-swiper title="Recommendation" :items="$recommends" />
    </section>
</x-main-layout>
