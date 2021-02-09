<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Number - create preference') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="h-screen">
                        <div class="text-left">
                            <div class="w-1/2 xl:w-2/4 px-3">
                                <div class="w-full bg-white border text-blue-700 rounded-lg flex items-center p-6 mb-6 xl:mb-0">
                                    <svg class="w-16 h-16 fill-current mr-4 lg:block" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="address-book" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                        <path fill="currentColor" d="M436 160c6.6 0 12-5.4 12-12v-40c0-6.6-5.4-12-12-12h-20V48c0-26.5-21.5-48-48-48H48C21.5 0 0 21.5 0 48v416c0 26.5 21.5 48 48 48h320c26.5 0 48-21.5 48-48v-48h20c6.6 0 12-5.4 12-12v-40c0-6.6-5.4-12-12-12h-20v-64h20c6.6 0 12-5.4 12-12v-40c0-6.6-5.4-12-12-12h-20v-64h20zm-228-32c35.3 0 64 28.7 64 64s-28.7 64-64 64-64-28.7-64-64 28.7-64 64-64zm112 236.8c0 10.6-10 19.2-22.4 19.2H118.4C106 384 96 375.4 96 364.8v-19.2c0-31.8 30.1-57.6 67.2-57.6h5c12.3 5.1 25.7 8 39.8 8s27.6-2.9 39.8-8h5c37.1 0 67.2 25.8 67.2 57.6v19.2z"></path>
                                    </svg>

                                    <div class="text-gray-700">
                                        <p class="font-semibold text-3xl">
                                            {{ $number->customer->name }}
                                        </p>
                                        <p>
                                            <span class="font-medium text-sm text-blue-500">Document:</span> {{ $number->customer->document }}
                                        </p>
                                        <p>
                                            <span class="font-medium text-sm text-blue-500">Number:</span> {{ $number->number }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('number.preferences.store', $number->id) }}">
                        @csrf
                            <div class="mt-4">
                                <x-label for="name" :value="__('Name')" />

                                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                            </div>
                            <div class="mt-4">
                                <x-label for="value" :value="__('Value')" />

                                <x-input id="value" class="block mt-1 w-full" type="text" name="value" :value="old('value')" required />
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <x-button class="ml-4 flex">
                                    {{ __('Save') }}
                                </x-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
