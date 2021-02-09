{{--<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">--}}
{{--    <div>--}}
{{--        {{ $logo }}--}}
{{--    </div>--}}

{{--    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">--}}
{{--        {{ $slot }}--}}
{{--    </div>--}}
{{--</div>--}}


{{--<div class="min-h-screen bg-gray-100 py-6 flex flex-col justify-center sm:py-12">--}}
<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div class="relative py-3 sm:max-w-xl sm:mx-auto">
        <div class="absolute inset-0 bg-gradient-to-r from-cyan-400 to-light-blue-500 shadow-lg transform -skew-y-6 sm:skew-y-0 sm:-rotate-6 sm:rounded-3xl">

        </div>
        <div class="relative px-4 py-10 bg-white shadow-lg sm:rounded-3xl sm:p-16">
            <div class="max-w-md mx-auto">
                <div class="flex justify-center pb-8">
                    {{ $logo }}
                </div>
                <div class="divide-y divide-gray-200">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</div>
