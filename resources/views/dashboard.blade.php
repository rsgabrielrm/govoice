<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="h-screen flex ">
                        <div class="flex flex-col lg:flex-row w-full lg:space-x-2 space-y-2 lg:space-y-0 mb-2 lg:mb-4">
                            <div class="w-full lg:w-1/3">
                                <div class="widget w-full p-4 rounded-lg bg-gray-400 border border-gray-100 dark:bg-gray-900 dark:border-gray-800">
                                    <div class="flex flex-row items-center text-white justify-between">
                                        <div class="flex flex-col">
                                            <div class="text-xs uppercase font-light text-white-500">
                                                {{ $userInfo['name'] }}
                                            </div>
                                            <div class="text-xl font-bold">
                                                {{ $userInfo['email'] }}
                                            </div>
                                        </div>
                                        <svg class="stroke-current text-white" fill="none" height="30" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewbox="0 0 24 24" width="30" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full lg:w-1/3">
                                <a href="{{ route('customers.index') }}">
                                    <div class="widget w-full p-4 rounded-lg bg-light-blue-500 border border-gray-100 dark:bg-gray-900 dark:border-gray-800">
                                        <div class="flex flex-row items-center text-white justify-between">
                                            <div class="flex flex-col">
                                                <div class="text-xs uppercase font-light ">
                                                    Customers
                                                </div>
                                                <div class="text-xl font-bold">
                                                    {{ $customers->count() }}
                                                </div>
                                            </div>
                                            <svg class="stroke-current text-white" fill="none" height="24" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewbox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2">
                                                </path>
                                                <circle cx="9" cy="7" r="4">
                                                </circle>
                                                <path d="M23 21v-2a4 4 0 0 0-3-3.87">
                                                </path>
                                                <path d="M16 3.13a4 4 0 0 1 0 7.75">
                                                </path>
                                            </svg>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="w-full lg:w-1/3">
                                <div class="widget w-full p-4 rounded-lg bg-green-500 border border-gray-100 dark:bg-gray-900 dark:border-gray-800">
                                    <div class="flex flex-row items-center text-white justify-between">
                                        <div class="flex flex-col">
                                            <div class="text-xs uppercase font-light ">
                                                Account Status
                                            </div>
                                            <div class="text-xl font-bold">
                                               Actived
                                            </div>
                                        </div>
                                        <svg class="stroke-current text-white" fill="none" height="30" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewbox="0 0 24 24" width="30" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
