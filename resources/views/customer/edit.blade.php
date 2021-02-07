<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Customers - edit') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="h-screen">

                        <form method="POST" action="{{ route('customer.update', $customer->id) }}">
                            @method('PUT')
                            @csrf
                            <div>
                                <x-label for="name" :value="__('Name')" />

                                <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ old('name', $customer->name )}}" required autofocus />
                            </div>

                            <div class="mt-4">
                                <x-label for="document" :value="__('Document')" />

                                <x-input id="document" class="block mt-1 w-full" type="text" name="document" value="{{ old('document', $customer->document) }}" required />
                            </div>
                            <div class="mt-4">
                                <x-label for="name" :value="__('Status')" />

                                <select id="status" name="status" class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    @foreach($statusOptions as $option)
                                        <option class="py-1" value="{{ $option }}" @if($option == $customer->status) selected @endif>{{ ucfirst($option) }}</option>
                                    @endforeach
                                </select>

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
