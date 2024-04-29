@props(['datas', 'value', 'name', 'label'])

<div class="relative flex flex-col gap-2 px-5" x-data="{ isOpen: false, value: '{{ $value }}', datas: {{ json_encode($datas) }}, search: '' }">
    <input type="hidden" name="{{ $name }}" :value="value">

    {{-- Label --}}
    <h1 class="text-sm font-bold">{{ $label }}</h1>

    {{-- Button Dropdown --}}
    <button x-ref="buttonDropdown" @click.prevent="isOpen = ! isOpen" class="flex flex-row justify-between rounded-lg bg-gray-700 px-3.5 py-1.5 text-sm">
        <span x-text="value"></span>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round" class="h-5 w-5">
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
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" class="absolute right-5 top-1/2 h-5 w-5 -translate-y-1/2 peer-focus:text-blue-500">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                <path d="M21 21l-6 -6" />
            </svg>
        </div>

        {{-- List Language --}}
        <section class="flex w-full flex-col items-start overflow-y-auto">
            <button x-show="search === ''" @click.prevent="value = 'None Selected'; isOpen = false" class="w-full px-5 py-1.5 text-start hover:bg-gray-600"
                :class="value === 'None Selected' ? 'bg-blue-500' : ''">
                None Selected
            </button>
            {{ $slot }}
        </section>
    </div>
</div>
