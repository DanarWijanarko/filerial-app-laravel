@props(['title', 'items', 'detailName' => ''])

<section x-data="{ mySwiper: false }">
    {{-- Section Title --}}
    <h1 class="text-3xl font-bold">{{ $title }}</h1>

    @if ((array) $items === [])
        <h1 class="flex h-96 items-center justify-center pt-8 text-xl font-bold text-white">
            We don't have enough data to suggest any TV shows based on {{ $detailName }}.
        </h1>
    @else
        {{-- Swiper --}}
        <div class="relative mt-5">
            {{-- Container --}}
            <swiper-container slides-per-view="5" space-between="7" speed="500" loop="false" css-mode="true" class="h-[510px] w-full" x-ref="mySwiper">
                @foreach ($items as $item)
                    <swiper-slide>
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
                                    <p class="line-clamp-5 h-36 text-xl">{{ $item->overview }}</p>
                                </div>
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
    @endif
</section>
