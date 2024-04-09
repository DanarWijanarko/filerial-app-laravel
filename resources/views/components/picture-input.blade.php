@props(['label', 'name', 'isImgExist'])

<div x-data="imgPrev('{{ $isImgExist ? asset('storage/' . $isImgExist) : null }}')" @rst-btn.window="imgsrc = '{{ asset('storage/' . $isImgExist) ? asset('storage/' . $isImgExist) : null }}'"
    class="flex w-full flex-col items-start justify-center">
    <h1 class="@error($name) text-red-500 @enderror mb-2 font-medium">{{ $label }}</h1>
    <label for="{{ $name }}" class="@error($name) border-red-600 @enderror picture-label">
        <div class="flex w-[22rem] flex-col items-center justify-center pb-6 pt-5" x-show="!imgsrc">
            <svg class="mb-4 h-8 w-8 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
            </svg>
            <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to upload</span> or drag and drop</p>
            <p class="text-xs text-gray-500">SVG, PNG, JPG or GIF (MAX. 1MB)</p>
        </div>
        <img :src="imgsrc" x-show="imgsrc" class="w-96">
        <input @change="previewFile" x-ref="myFile" id="{{ $name }}" type="file" name="{{ $name }}" value="{{ old($name) }}"
            class="hidden" />
    </label>
    @error($name)
        <p class="mt-2 text-xs font-medium text-red-500">{{ $message }}</p>
    @enderror
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('imgPrev', (value) => ({
            imgsrc: value ? value : null,
            previewFile() {
                let file = this.$refs.myFile.files[0];
                if (!file || file.type.indexOf('image/') === -1) return;
                this.imgsrc = null;
                let reader = new FileReader();

                reader.onload = e => {
                    this.imgsrc = e.target.result;
                }
                reader.readAsDataURL(file);
            },
        }))
    })
</script>
