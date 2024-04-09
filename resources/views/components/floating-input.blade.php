@props(['type', 'name', 'label'])

<div class="group relative z-0 mb-5 w-full" x-data="{ isVisible: false }">
    <input :type="isVisible ? 'text' : '{{ $type }}'" id="{{ $name }}" name="{{ $name }}" placeholder=" " value="{{ old($name) }}"
        class="floating-input @error($name) border-red-500 @enderror peer" />
    <label for="{{ $name }}" class="floating-label @error($name) text-red-500 @enderror">
        {{ $label }}
    </label>
    @if ($type === 'password')
        <button type="button" @click="isVisible = ! isVisible" class="absolute right-2 top-[11px]">
            {{-- Eye On --}}
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" x-show="isVisible === false"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-gray-700">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
            </svg>
            {{-- Eye Off --}}
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" x-show="isVisible === true"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-gray-700">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M10.585 10.587a2 2 0 0 0 2.829 2.828" />
                <path
                    d="M16.681 16.673a8.717 8.717 0 0 1 -4.681 1.327c-3.6 0 -6.6 -2 -9 -6c1.272 -2.12 2.712 -3.678 4.32 -4.674m2.86 -1.146a9.055 9.055 0 0 1 1.82 -.18c3.6 0 6.6 2 9 6c-.666 1.11 -1.379 2.067 -2.138 2.87" />
                <path d="M3 3l18 18" />
            </svg>
        </button>
    @endif
    @error($name)
        <p class="mt-2 text-xs font-medium text-red-500">{{ $message }}</p>
    @enderror
</div>
