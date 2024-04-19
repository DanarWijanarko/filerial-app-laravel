@section('title')
    {{ __('Edit Profile') }}
@endsection

<x-main-layout>
    {{-- Page Info & Buttons Delete Acc --}}
    <section class="mb-5 ml-2 mr-5 mt-5 flex flex-row items-center justify-between">
        {{-- Page Info --}}
        <div class="flex flex-row items-center gap-3">
            <span class="h-16 w-2 bg-blue-950"></span>
            <div class="flex flex-col" <h1 class="text-lg text-gray-400">Profile</h1>
                <h2 class="text-2xl font-extrabold text-white">Edit Profile</h2>
            </div>
        </div>

        {{-- Delete Acc --}}
        <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
            class="rounded-lg bg-red-600 px-3 py-2 text-sm font-medium text-white transition-all hover:bg-red-700 active:scale-95">
            Delete Account
        </button>

        {{-- Delete Form --}}
        <x-modal name="confirm-user-deletion" :show="$errors->any()">
            <form action="{{ route('user.destroy') }}" method="POST">
                @csrf
                @method('delete')
                <h2 class="text-lg font-medium text-white">
                    Are you sure you want to delete your account?
                </h2>
                <p class="mb-3 mt-1 text-sm text-gray-400">
                    Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would
                    like to permanently delete your account.
                </p>
                <x-default-input type="password" label="Password" name="passwordDelete" placeholder="" />
                <div class="mt-6 flex justify-end gap-3">
                    <button x-on:click.prevent="$dispatch('close')"
                        class="rounded-lg border-2 border-red-600 px-3 py-2 text-sm font-medium text-white transition-all hover:border-red-700 hover:bg-red-700 active:scale-95">
                        Cancel
                    </button>

                    <button type="submit"
                        class="rounded-lg border-2 border-red-600 bg-red-600 px-3 py-2 text-sm font-medium text-white transition-all hover:border-red-700 hover:bg-red-700 active:scale-95">
                        Delete Account
                    </button>
                </div>
            </form>
        </x-modal>
    </section>

    {{-- Edit --}}
    <section class="ml-2 mr-5 flex flex-row gap-5">
        {{-- Account Details --}}
        <div class="h-fit w-full overflow-hidden rounded-lg bg-gray-800 px-5 pb-5 pt-3">
            {{-- Title --}}
            <h1 class="mb-3.5 w-full border-b border-gray-700 pb-2 text-xl font-bold text-white">
                Account Details
            </h1>

            {{-- Form --}}
            <form action="{{ route('user.update') }}" method="POST">
                @csrf
                @method('put')
                <x-default-input type="text" label="Full Name" name="name" :value="$user->name" />
                <x-default-input type="text" label="Username" name="username" :value="$user->username" />
                <x-default-input type="text" label="Email Address" name="email" :value="$user->email" />
                <x-default-input type="text" label="Address" name="address" :value="$user->address" />

                {{-- Social Media --}}
                <div x-data="{ data: JSON.parse(`{{ json_encode(old('social', $user->social ?? [['type' => '', 'username' => '']])) }}`) }" class="mb-5">
                    <template x-for="(object, index) in data" :key="index">
                        <div class="mb-4 grid grid-cols-11 gap-5">
                            {{-- Select Social Media --}}
                            <div class="col-span-5">
                                <label :for="`${index}-socialMedia`" class="default-label @error('social.*.type') text-red-500 @enderror">
                                    Select an Social Media
                                </label>
                                <select :id="`${index}-socialMedia`" :name="`social[${index}][type]`" class="default-input">
                                    <option selected>Choose a Social Media</option>
                                    <option :selected="data[`${index}`]['type'] === 'https://www.instagram.com/'" value="https://www.instagram.com/">
                                        Instagram
                                    </option>
                                    <option :selected="data[`${index}`]['type'] === 'https://www.tiktok.com/@'" value="https://www.tiktok.com/@">
                                        Tiktok
                                    </option>
                                    <option :selected="data[`${index}`]['type'] === 'https://www.facebook.com/'" value="https://www.facebook.com/">
                                        Facebook
                                    </option>
                                </select>
                                @error('social.*.type')
                                    <p class="mt-2 text-xs font-medium text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Social Media Username --}}
                            <div class="col-span-5">
                                <label :for="`${index}-socialUsername`" class="default-label @error('social.*.username') text-red-500 @enderror">
                                    Username <span class="text-xs text-gray-400">(Social Media)</span>
                                </label>
                                <input type="text" :id="`${index}-socialUsername`" :name="`social[${index}][username]`" placeholder="Not set"
                                    autocomplete="off" :value="data[`${index}`]['username']"
                                    class="default-input @error('`social[${index}][username]`') border-2 border-red-500 @enderror" />
                                @error('social.*.username')
                                    <p class="mt-2 text-xs font-medium text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Add or Remove Social Media Rows --}}
                            <div class="col-span-1">
                                <p class="default-label cursor-default opacity-0">w</p>
                                <template x-if="index === 0">
                                    <button type="button" @click="data.push({ type: '', username: '' })" class="rounded-full bg-blue-600 p-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="h-7 w-7">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M12 5l0 14" />
                                            <path d="M5 12l14 0" />
                                        </svg>
                                    </button>
                                </template>
                                <template x-if="index > 0">
                                    <button type="button" @click="data.splice(index, 1)" class="rounded-full bg-red-600 p-2">
                                        <svg xmlns="http://www.w3.org/2000/svg"viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="h-7 w-7">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M5 12l14 0" />
                                        </svg>
                                    </button>
                                </template>
                            </div>
                        </div>
                    </template>
                </div>

                {{-- Buttons --}}
                <div class="float-right flex flex-row gap-5">
                    <button type="reset"
                        class="rounded-lg border-2 border-blue-700 px-5 py-1.5 text-sm font-medium tracking-widest text-white transition-all hover:border-blue-600 hover:bg-blue-600 active:scale-95">
                        Reset
                    </button>
                    <button type="submit"
                        class="rounded-lg bg-blue-700 px-5 py-1.5 text-sm font-medium tracking-widest text-white transition-all hover:bg-blue-600 active:scale-95">
                        Save
                    </button>
                </div>
            </form>
        </div>

        {{-- Right Section --}}
        <div class="flex w-full flex-col gap-5">
            {{-- Account Images --}}
            <div class="col-span-3 row-span-3 overflow-hidden rounded-lg bg-gray-800 px-5 py-3">
                {{-- Title --}}
                <h1 class="mb-3.5 w-full border-b border-gray-700 pb-2 text-xl font-bold text-white">
                    Account Images
                </h1>

                {{-- Form --}}
                <form action="{{ route('user.update.images') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="mb-5 grid grid-cols-2 gap-5">
                        <div class="col-span-1 flex flex-col">
                            <x-picture-input label="Profile Picture" name="profile_picture" :isImgExist="$user->picture" />
                            <input type="hidden" name="oldProfileImg" value="{{ $user->picture }}">
                        </div>
                        <div class="col-span-1 flex flex-col">
                            <x-picture-input label="Backdrop Picture" name="backdrop_picture" :isImgExist="$user->backdrop" />
                            <input type="hidden" name="oldBackdropImg" value="{{ $user->backdrop }}">
                        </div>
                    </div>

                    {{-- Buttons --}}
                    <div class="float-right flex flex-row gap-5">
                        <button type="reset" x-data @click="$dispatch('rst-btn', true)"
                            class="rounded-lg border-2 border-blue-700 px-5 py-1.5 text-sm font-medium tracking-widest text-white transition-all hover:border-blue-600 hover:bg-blue-600 active:scale-95">
                            Reset
                        </button>
                        <button type="submit"
                            class="rounded-lg bg-blue-700 px-5 py-1.5 text-sm font-medium tracking-widest text-white transition-all hover:bg-blue-600 active:scale-95">
                            Save
                        </button>
                    </div>
                </form>
            </div>

            {{-- Change Password --}}
            <div class="col-span-3 row-span-3 overflow-hidden rounded-lg bg-gray-800 px-5 py-3">
                {{-- Titile --}}
                <h1 class="mb-3.5 w-full border-b border-gray-700 pb-2 text-xl font-bold text-white">
                    Change Password
                </h1>

                {{-- Form --}}
                <form action="{{ route('user.update.password') }}" method="POST">
                    @csrf
                    @method('put')
                    <x-default-input type="password" label="Current Password" name="current_password" placeholder="" />
                    <x-default-input type="password" label="New Password" name="password" placeholder="" />
                    <x-default-input type="password" label="Confirm Password" name="password_confirmation" placeholder="" />

                    {{-- Buttons --}}
                    <div class="float-right flex flex-row gap-5">
                        <button type="reset"
                            class="hover:boder-blue-600 rounded-lg border-2 border-blue-700 px-5 py-1.5 text-sm font-medium tracking-widest text-white transition-all hover:bg-blue-600 active:scale-95">
                            Reset
                        </button>
                        <button type="submit"
                            class="rounded-lg bg-blue-700 px-5 py-1.5 text-sm font-medium tracking-widest text-white transition-all hover:bg-blue-600 active:scale-95">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</x-main-layout>
