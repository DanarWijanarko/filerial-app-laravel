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

        {{-- Country, Seasons, Episodes, Runtime --}}
        <div class="flex w-full flex-row items-center gap-2 font-medium">
            {{-- Origin Country --}}
            <p class="text-xl font-medium text-gray-400">
                {{ $detail->origin_country }}
            </p>

            <span class="h-2 w-2 rounded-full bg-gray-600"></span>

            {{-- Season Number --}}
            <p class="text-xl font-medium text-gray-400">
                {{ $detail->number_of_seasons }} {{ $detail->number_of_seasons > 1 ? __('Seasons') : __('Season') }}
            </p>

            <span class="h-2 w-2 rounded-full bg-gray-600"></span>

            {{-- Episode Number --}}
            <p class="text-xl font-medium text-gray-400">
                {{ $detail->number_of_episodes }} {{ $detail->number_of_episodes > 1 ? __('Episodes') : __('Episode') }}
            </p>

            <span class="h-2 w-2 rounded-full bg-gray-600"></span>

            {{-- Per Episode Runtime --}}
            <p class="text-xl font-medium text-gray-400">
                {{ $detail->episode_run_time }}
            </p>
        </div>

        {{-- Realease - End Date --}}
        <div class="flex flex-row items-center gap-2">
            <p class="text-xl font-medium text-gray-400">
                {{ $detail->first_air_date }}
            </p>
            <span class="h-0.5 w-3 rounded-full bg-gray-600"></span>
            <p class="text-xl font-medium text-gray-400">
                {{ $detail->last_air_date }}
            </p>
        </div>

        {{-- Original Name, Popularity, Vote Average & Count --}}
        <div class="my-0.5 flex flex-row items-center gap-5 text-gray-400">
            {{-- Original Name --}}
            <span class="relative flex flex-row items-center gap-1" x-data="{ isOpen: false }">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round"
                    stroke-linejoin="round" class="h-7 w-7 text-gray-600" x-on:mouseover="isOpen =  true" x-ref="link" x-on:mouseout="isOpen = false">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path
                        d="M3 19c3.333 -2 5 -4 5 -6c0 -3 -1 -3 -2 -3s-2.032 1.085 -2 3c.034 2.048 1.658 2.877 2.5 4c1.5 2 2.5 2.5 3.5 1c.667 -1 1.167 -1.833 1.5 -2.5c1 2.333 2.333 3.5 4 3.5h2.5" />
                    <path d="M20 17v-12c0 -1.121 -.879 -2 -2 -2s-2 .879 -2 2v12l2 2l2 -2z" />
                    <path d="M16 7h4" />
                </svg>
                <p>{{ $detail->original_name }}</p>
                <div x-show="isOpen" x-anchor.top.offset.5="$refs.link" class="rounded-md bg-gray-800 px-2 py-1 text-base font-bold text-gray-100">
                    Original Name
                </div>
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

        {{-- Original Networks --}}
        <div class="flex flex-row items-center gap-1">
            <p class="font-bold text-gray-600">Original Networks:</p>
            @foreach ($detail->networks as $index => $network)
                <a href="{{ route('explore', ['to' => 'networks', 'name' => $network->name, 'id' => $network->id, 'media_type' => $detail->mediaType]) }}"
                    class="font-medium text-gray-400 transition-all hover:text-purple-600 hover:underline">
                    {{ $network->name }}
                </a>
                @if ($index < count($detail->networks) - 1)
                    <p class="text-gray-600">, </p>
                @endif
            @endforeach
        </div>

        {{-- Genres --}}
        <div class="flex w-full flex-row items-center gap-3 font-medium">
            @foreach ($detail->genres as $index => $genre)
                <a href="{{ route('explore', ['to' => 'genre', 'name' => $genre->name, 'id' => $genre->id, 'media_type' => $detail->mediaType]) }}"
                    class="text-xl font-medium text-gray-400 transition-all hover:text-blue-600 hover:underline">
                    {{ $genre->name }}
                </a>
                @if ($index < count($detail->genres) - 1)
                    <span class="h-5 w-0.5 rounded-full bg-gray-600"></span>
                @endif
            @endforeach
        </div>

        {{-- Production Companies --}}
        <div class="my-1.5 flex flex-row gap-3">
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
            {{-- Add to Favorite --}}
            <form action="{{ route('shows.store') }}" method="POST">
                @csrf
                <input type="hidden" name="data[mediaType]" value="{{ $detail->mediaType }}">
                <input type="hidden" name="data[slug]" value="{{ Str::slug($detail->name) }}">
                <input type="hidden" name="data[id]" value="{{ $detail->id }}">
                <input type="hidden" name="data[poster]" value="{{ $detail->poster }}">
                <input type="hidden" name="data[name]" value="{{ $detail->name }}">
                <input type="hidden" name="data[backdrop]" value="{{ $detail->backdrop }}">
                <input type="hidden" name="data[release_date]" value="{{ $detail->first_air_date }}">
                <input type="hidden" name="data[origin_country]" value="{{ $detail->origin_country }}">
                <input type="hidden" name="data[vote_average]" value="{{ $detail->vote_average }}">
                <input type="hidden" name="data[overview]" value="{{ $detail->overview }}">
                <button type="submit"
                    class="flex flex-row items-center gap-2 rounded-md bg-blue-600 px-3 py-2 font-bold transition-all hover:bg-blue-700 active:scale-95">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" class="h-7 w-7">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" />
                    </svg>
                    Add to Favorite
                </button>
            </form>

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
        @if ($detail->videos !== null)
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
        @endif
    </div>
</section>
