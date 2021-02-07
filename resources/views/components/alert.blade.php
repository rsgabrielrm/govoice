@if($type === 'success')
    <div x-data="{ show: true }" x-show="show" class="pt-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="text-white px-6 py-4 border-0 rounded relative mb-4 bg-green-500">
            <span class="text-xl inline-block mr-5 align-middle">
                <svg class="w-5 h-5 text-white" aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </span>
            <span class="inline-block align-middle mr-8">
                {{ $text }}
            </span>
            <button @click="show = false" class="absolute bg-transparent text-2xl font-semibold leading-none right-0 top-0 mt-4 mr-6 outline-none focus:outline-none">
                <span>×</span>
            </button>
        </div>
    </div>
@endif
@if($type === 'warning')
    <div x-data="{ show: true }" x-show="show" class="pt-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="text-white px-6 py-4 border-0 rounded relative mb-4 bg-yellow-400 ">
            <span class="text-xl inline-block mr-5 align-middle">
                <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </span>
            <span class="inline-block align-middle mr-8">
                {{ $text }}
            </span>
            <button @click="show = false" class="absolute bg-transparent text-2xl font-semibold leading-none right-0 top-0 mt-4 mr-6 outline-none focus:outline-none">
                <span>×</span>
            </button>
        </div>
    </div>
@endif
@if($type === 'error')
    <div x-data="{ show: true }" x-show="show" class="pt-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="text-white px-6 py-4 border-0 rounded relative mb-4 bg-red-400">
            <span class="text-xl inline-block mr-5 align-middle">
                <svg class="w-5 h-5 text-white" aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </span>
            <span class="inline-block align-middle mr-8">
                {{ $text }}
            </span>
            <button @click="show = false" class="absolute bg-transparent text-2xl font-semibold leading-none right-0 top-0 mt-4 mr-6 outline-none focus:outline-none">
                <span>×</span>
            </button>
        </div>
    </div>
@endif
