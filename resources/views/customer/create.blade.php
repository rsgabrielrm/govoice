<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Customers - create') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="h-screen">

                        <form method="POST" action="{{ route('customer.store') }}">
                        @csrf
                            <div>
                                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                            </div>
                            <div>
                                <x-label for="name" :value="__('Name')" />

                                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                            </div>

                            <div class="mt-4">
                                <x-label for="document" :value="__('Document')" />

                                <x-input id="document" class="block mt-1 w-full" type="text" name="document" :value="old('document')" required />
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