@section('title')
    {{ $detail->name }}
@endsection

<x-main-layout>
    {{-- Information Section --}}
    @include('pages.main.shows.partials.informations')

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
                        <a href="{{ route('person.detail', ['name' => $credit->slug, 'id' => $credit->id]) }}" class="flex h-full flex-row gap-2 object-cover">
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
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"
                    stroke-linecap="round" stroke-linejoin="round" class="h-10 w-10 -translate-x-1.5 transition-all group-hover:translate-x-0">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M15 6l-6 6l6 6" />
                </svg>
            </button>
            <button @click="$refs.mySwiper.swiper.slideNext()"
                class="group absolute right-0 top-0 z-30 h-full transition-all duration-500 hover:bg-gradient-to-l hover:from-gray-900 hover:to-transparent">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"
                    stroke-linecap="round" stroke-linejoin="round" class="h-10 w-10 translate-x-1.5 transition-all group-hover:translate-x-0">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M9 6l6 6l-6 6" />
                </svg>
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
                Showing <span class="font-semibold text-purple-500">
                    {{ ($images->pagination->current_page - 1) * $images->pagination->per_page + 1 }}
                </span>
                to <span class="font-semibold text-purple-500">
                    {{ min($images->pagination->current_page * $images->pagination->per_page, $images->pagination->total) }}
                </span>
                of <span class="font-semibold text-purple-500">
                    {{ $images->pagination->total }}
                </span>
            </h2>

            {{-- Pagination Buttons --}}
            <div class="flex flex-row" x-data="{ trigBtn: null }">
                <a href="{{ request()->fullUrlWithQuery(['gallery_page' => $images->pagination->current_page - 1]) }}"
                    @click="window.sessionStorage.setItem('scrollPosition', window.pageYOffset || document.documentElement.scrollTop)"
                    class="{{ $images->pagination->current_page > 1 ? 'bg-gray-700' : 'pointer-events-none bg-gray-600' }} rounded-l-lg border-y border-l border-gray-600 p-1.5">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round"
                        stroke-linejoin="round" class="h-5 w-5">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M15 6l-6 6l6 6" />
                    </svg>
                </a>
                <a href="{{ request()->fullUrlWithQuery(['gallery_page' => $images->pagination->current_page + 1]) }}"
                    @click="window.sessionStorage.setItem('scrollPosition', window.pageYOffset || document.documentElement.scrollTop)"
                    class="{{ $images->pagination->current_page < $images->pagination->last_page ? 'bg-gray-700' : 'pointer-events-none bg-gray-600' }} rounded-r-lg border border-gray-600 p-1.5">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round"
                        stroke-linejoin="round" class="h-5 w-5">
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

    <span class="mb-7 mt-11 flex h-0.5 w-full rounded-full bg-gray-800"></span>

    {{-- Episodes Section --}}
    <section class="w-full px-5">
        {{-- Section Title --}}
        <h1 class="text-3xl font-bold">Episodes</h1>

        {{-- Select Seasons --}}
        <div x-data="select('{{ $episodes[0]->season_number }}')" class="relative z-40 my-5 h-10 w-44" @click.outside="open = false">
            {{-- Button Dropdown --}}
            <button type="button" @click.prevent="toggle($event)" :class="(open) && 'ring-purple-600'"
                class="flex h-full w-full items-center justify-between rounded-lg border border-gray-500 bg-gray-600 p-3 transition-all hover:bg-gray-700 focus:border-purple-600 focus:ring-1 focus:ring-purple-600">
                <p class="text-lg font-bold">Season <span x-text="season"></span></p>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round"
                    stroke-linejoin="round" class="h-5 w-5">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M6 9l6 6l6 -6" />
                </svg>
            </button>

            {{-- Dropdown Content --}}
            <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 origin-top scale-0"
                x-transition:enter-end="opacity-100 origin-top scale-100" x-transition:leave="transition ease-in duration-100"
                x-transition:leave-start="opacity-100 origin-top scale-100" x-transition:leave-end="opacity-0 origin-top scale-0"
                class="absolute mt-1 flex w-full flex-col gap-1 rounded-lg bg-gray-500 py-2">
                @foreach (range(1, $detail->number_of_seasons) as $season)
                    <a href="{{ request()->fullUrlWithQuery(['season_number' => $season]) }}" @click="setSeason" @class([
                        'w-full px-3 py-0.5 text-start transition-all duration-300 hover:bg-purple-500',
                        'pointer-events-none bg-purple-500' =>
                            $episodes[0]->season_number === $season,
                    ])>
                        Season {{ $season }}
                    </a>
                @endforeach
            </div>
        </div>

        {{-- Section Contents --}}
        <div x-data="{ expanded: false }" x-show="expanded" x-collapse.min.1705px.duration.1000ms class="relative mt-1 flex flex-col gap-5 pb-10">
            {{-- Data Loop --}}
            @foreach ($episodes as $ep)
                <div class="flex w-full flex-row gap-5">
                    {{-- Poster --}}
                    <img src="{{ $ep->poster }}" alt="{{ $ep->name }}" class="h-48 w-[21.3rem] rounded-lg object-cover">

                    {{-- Details --}}
                    <div class="flex flex-col gap-0.5 pt-1.5">
                        {{-- Name --}}
                        <h1 class="text-2xl font-extrabold text-white">
                            {{ $ep->name }}
                        </h1>

                        {{-- Air Date --}}
                        <p class="text-xl font-bold text-gray-400">
                            {{ $ep->air_date }}
                        </p>

                        {{-- Season & Episode Number, Runtime, Vote Average & Count --}}
                        <div class="flex flex-row items-center gap-2">
                            {{-- Season & Episode Number --}}
                            <p class="text-lg font-bold text-gray-400">
                                S<span id="#seasonNumber">{{ $ep->season_number }}</span>E{{ $ep->episode_number }}
                            </p>

                            <span class="h-2 w-2 rounded-full bg-gray-600"></span>

                            {{-- Runtime --}}
                            <p class="text-lg font-bold text-gray-400">
                                {{ $ep->runtime }}
                            </p>

                            <span class="h-2 w-2 rounded-full bg-gray-600"></span>

                            {{-- Vote Average --}}
                            <p class="text-lg font-bold text-gray-400">
                                {{ $ep->vote_average }}
                            </p>

                            <span class="h-2 w-2 rounded-full bg-gray-600"></span>

                            {{-- Vote Count --}}
                            <p class="text-lg font-bold text-gray-400">
                                {{ $ep->vote_count }}
                            </p>
                        </div>

                        {{-- Overview --}}
                        <h2 class="line-clamp-3 text-justify text-lg font-normal text-gray-400">
                            {{ $ep->overview }}
                        </h2>
                    </div>
                </div>
            @endforeach

            {{-- Collapse Button --}}
            @if ($episodes->count() > 8)
                <button type="button" @click="expanded = ! expanded"
                    class="group absolute bottom-0 flex h-fit w-full items-end justify-center bg-gradient-to-t from-gray-900 from-30% to-transparent transition-all hover:h-24">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4"
                        stroke-linecap="round" stroke-linejoin="round"
                        class="bottom-1 h-10 w-10 transition-all group-hover:scale-110 group-hover:text-gray-300">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M6 9l6 6l6 -6" x-bind:d="expanded ? 'M6 15l6 -6l6 6' : 'M6 9l6 6l6 -6'" />
                    </svg>
                </button>
            @endif
        </div>
    </section>

    <span class="mb-7 mt-9 flex h-0.5 w-full rounded-full bg-gray-800"></span>

    {{-- Recommendations Section --}}
    <section class="w-full px-5">
        <x-swiper title="Recommendation" :detailName="$detail->name" :items="$recommends" />
    </section>
</x-main-layout>

<script>
    document.addEventListener("alpine:init", () => {
        Alpine.data("select", (sesVal = 1) => ({
            open: false,
            season: sesVal,

            toggle(event) {
                event.preventDefault()
                this.open = !this.open;
            },

            setSeason() {
                this.open = false;
                var offsetTop = window.pageYOffset || document.documentElement.scrollTop;
                window.sessionStorage.setItem('scrollPosition', offsetTop);
            },
        }));
    });
</script>
