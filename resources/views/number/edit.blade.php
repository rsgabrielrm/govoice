<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Numbers - edit') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="h-screen">

                        <form method="POST" action="{{ route('numbers.update', $number->id) }}">
                            @method('PUT')
                            @csrf
                            <div>
                                <x-label for="name" :value="__('Customer')" />

                                <select id="customer_id" name="customer_id" class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    @foreach($customers as $customer)
                                        <option class="py-1" value="{{ $customer->id }}" @if($customer->id == $number->customer_id) selected @endif >{{ $customer->name }}</option>
                                    @endforeach
                                </select>

                            </div>

                            <div class="mt-4">
                                <x-label for="number" :value="__('Number')" />

                                <x-input id="number" class="block mt-1 w-full" type="text" name="number" value="{{ old('number', $number->number) }}" required />
                            </div>
                            <div class="mt-4">
                                <x-label for="name" :value="__('Status')" />

                                <select id="status" name="status" class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    @foreach($statusOptions as $option)
                                        <option class="py-1" value="{{ $option }}" @if($option == $number->status) selected @endif>{{ ucfirst($option) }}</option>
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
