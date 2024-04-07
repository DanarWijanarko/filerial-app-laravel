@session('status')
    <div x-data="{ isOpen: true }" x-show="isOpen" x-init="setTimeout(() => {
        isOpen = false
    }, 5000);" @class([
        'fixed left-1/2 top-10 z-50 flex -translate-x-1/2 items-center border-t-4 p-4',
        'border-green-800 bg-green-600 text-green-100' =>
            session('status')->type === 'success',
        'border-red-800 bg-red-600 text-red-100' =>
            session('status')->type === 'error',
    ])>
        <svg svg class ="h-4 w-4 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path
                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
        </svg>
        <p class="mx-3 text-sm font-bold">
            {{ session('status')->message }}
        </p>
        <button type="button" @click="isOpen = false" @class([
            '-my-1.5 -mr-1.5 inline-flex h-8 w-8 items-center justify-center rounded-lg p-1.5',
            'border-green-800 bg-green-600 text-green-100' =>
                session('status')->type === 'success',
            'border-red-800 bg-red-600 text-red-100' =>
                session('status')->type === 'error',
        ])>
            <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
        </button>
    </div>
@endSession
