@props(['name', 'show' => false])

<section x-data="{ show: @js($show) }" x-on:open-modal.window="$event.detail == '{{ $name }}' ? show = true : null"
    x-on:close-modal.window="$event.detail == '{{ $name }}' ? show = false : null" x-on:close.stop="show = false" x-on:keydown.escape.window="show = false"
    x-on:keydown.tab.prevent="$event.shiftKey" x-show="show" class="fixed left-0 top-0 z-50 h-full w-full">
    <div>
        <div x-show="show" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="fixed left-1/2 top-1/2 z-50 -translate-x-1/2 w-[33rem] -translate-y-1/2 rounded-lg bg-gray-800 p-5 text-white shadow-xl transition-all"
            style="display: {{ $show ? 'block' : 'none' }};">
            {{ $slot }}
        </div>
    </div>
    <div x-show="show" class="fixed left-0 top-0 z-20 h-full w-full transform bg-black/50 transition-all" x-on:click="show = false"
        x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>
</section>
