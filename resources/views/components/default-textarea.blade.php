@props(['name', 'label'])

<div class="mb-5 w-full">
    <label for="{{ $name }}" class="default-label @error($name) text-red-500 @enderror">{{ $label }}</label>
    <textarea name="{{ $name }}" id="{{ $name }}" class="default-input @error($name) border-2 border-red-500 @enderror">{{ old($name) }}</textarea>
    @error($name)
        <p class="mt-2 text-xs font-medium text-red-500">{{ $message }}</p>
    @enderror
</div>
