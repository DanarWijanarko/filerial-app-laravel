@props(['name', 'label' => null])

<section x-data="myDatePicker" x-init="getNoOfDays()" class="w-full">
    <input type="hidden" id="{{ $name }}" name="{{ $name }}" x-ref="date" :value="datepickerValue" />

    @if ($label !== null)
        <label for="{{ $name }}" class="text-sm text-gray-400 mb-1">{{ $label }}</label>
    @endif

    {{-- Button Show Date Picker --}}
    <button x-ref="buttonDropdownDatePicker" @click.prevent="showDatepicker = ! showDatepicker"
        class="relative flex w-full flex-row justify-between rounded-lg bg-gray-700 px-3.5 py-1.5 text-sm">
        <span x-text="datepickerValue"></span>
        <div class="absolute right-1.5 top-1/2 -translate-y-1/2">
            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
        </div>
    </button>

    {{-- Show Date Picker --}}
    <div x-show="showDatepicker" @click.outside="showDatepicker = false" x-anchor.bottom.offset.5="$refs.buttonDropdownDatePicker" x-transition
        class="z-50 flex h-fit w-[87%] flex-col items-start rounded-lg bg-gray-700 px-3 py-2 text-sm">
        {{-- Show Month & Change Month Buttons --}}
        <div class="mb-2 flex w-full items-center justify-between">
            {{-- Month & Year Now --}}
            <div class="flex flex-row items-center gap-1">
                <span x-text="MONTH_NAMES[month]" class="text-lg font-bold text-white"></span>
                <span x-text="year" class="ml-1 text-lg font-normal text-gray-300"></span>
            </div>

            {{-- Change Month Buttons --}}
            <div class="-mr-1.5 flex flex-row items-center gap-1">
                {{-- Prev --}}
                <button type="button" class="flex cursor-pointer items-center justify-center rounded-full p-1 text-white transition-all hover:bg-gray-500"
                    @click="if (month == 0) {
												year--;
												month = 12;
											} month--; getNoOfDays()">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                {{-- Next --}}
                <button type="button" class="flex cursor-pointer items-center justify-center rounded-full p-1 text-white transition-all hover:bg-gray-500"
                    @click="if (month == 11) {
												month = 0;
												year++;
											} else {
												month++;
											} getNoOfDays()">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        </div>

        {{-- Show Days --}}
        <div class="flex w-full flex-row items-center gap-1">
            <template x-for="(day, index) in DAYS" :key="index">
                <div x-text="day" class="w-1/6 text-center text-xs font-medium text-gray-200"></div>
            </template>
        </div>

        {{-- Show Day Values --}}
        <div class="mt-1 grid w-full grid-cols-7 gap-2">
            <template x-for="blankday in blankdays">
                <div class="col-span-1 w-1/6 border border-transparent p-1 text-center text-sm"></div>
            </template>
            <template x-for="(date, dateIndex) in no_of_days" :key="dateIndex">
                <div @click="getDateValue(date)" x-text="date"
                    class="col-span-1 cursor-pointer rounded-full p-1 text-center text-sm leading-none transition duration-100 ease-in-out"
                    :class="{
                        'bg-blue-700': isToday(date) == true,
                        'text-gray-200 hover:bg-blue-500': isToday(date) == false && isSelectedDate(date) == false,
                        'bg-blue-500 text-white hover:bg-opacity-75': isSelectedDate(date) == true
                    }">
                </div>
            </template>
        </div>
    </div>
</section>
