@if ($paginator->hasPages())
    <section class="flex flex-row items-center justify-between" x-data="{ trigBtn: null }">
        {{-- Page Information --}}
        <div class="flex flex-row gap-1">
            <p class="text-sm font-medium leading-5 text-gray-400">Showing</p>
            @if ($paginator->firstItem())
                <p class="text-sm font-semibold leading-5 text-white">{{ $paginator->firstItem() }}</p>
                <p class="text-sm font-medium leading-5 text-gray-400">to</p>
                <p class="text-sm font-semibold leading-5 text-white">{{ $paginator->lastItem() }}</p>
            @else
                <p class="text-sm font-semibold leading-5 text-white">{{ $paginator->count() }}</p>
            @endif
            <p class="text-sm font-medium leading-5 text-gray-400">of</p>
            <p class="text-sm font-semibold leading-5 text-white">{{ $paginator->total() }}</p>
        </div>

        {{-- Page Links Button --}}
        <div class="flex flex-row text-sm text-gray-400">
            {{-- Previous Page Link --}}
            <a href="{{ $paginator->previousPageUrl() }}"
                @click="window.sessionStorage.setItem('scrollPosition', window.pageYOffset || document.documentElement.scrollTop)"
                class="{{ $paginator->onFirstPage() ? 'pointer-events-none bg-black/20' : 'bg-gray-800 hover:bg-black/20' }} inline-flex items-center rounded-l-lg border border-y-2 border-l-2 border-gray-700/70 px-1.5 py-2 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="h-5 w-5">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M15 6l-6 6l6 6" />
                </svg>
            </a>

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span aria-disabled="true">
                        <span
                            class="-ml-px inline-flex cursor-default items-center border border-y-2 border-gray-700/70 bg-gray-800 px-4 py-2 text-sm font-medium leading-5 text-gray-500">{{ $element }}</span>
                    </span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        <a href="{{ $url }}"
                            @click="window.sessionStorage.setItem('scrollPosition', window.pageYOffset || document.documentElement.scrollTop)"
                            class="{{ $page === $paginator->currentPage() ? 'pointer-events-none bg-black/20' : 'bg-gray-800 hover:bg-black/20' }} inline-flex items-center border border-y-2 border-gray-700/70 px-4 py-2 transition-all">
                            {{ $page }}
                        </a>
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            <a href="{{ $paginator->nextPageUrl() }}"
                @click="window.sessionStorage.setItem('scrollPosition', window.pageYOffset || document.documentElement.scrollTop)"
                class="{{ $paginator->hasMorePages() ? 'bg-gray-800 hover:bg-black/20' : 'pointer-events-none bg-black/20' }} inline-flex items-center rounded-r-lg border border-y-2 border-r-2 border-gray-700/70 px-1.5 py-2 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="h-5 w-5">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M9 6l6 6l-6 6" />
                </svg>
            </a>
        </div>
    </section>
@endif
