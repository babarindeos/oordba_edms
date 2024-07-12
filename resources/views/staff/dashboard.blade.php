<x-staff-layout>

<div class="flex flex-col container mx-4 border border-0 md:mx-auto">
    <section class="border-b border-gray-200 py-2 mt-2">
            <div class="text-2xl font-semibold ">
                Dashboard                
            </div>
            <div>
                @if (Auth::check())
                    Welcome {{ Auth::user()->surname }} {{ Auth::user()->firstname}}
                @endif
            </div>
    </section>

    <section class="flex flex-col md:flex-row md:space-x-4">
        <div class="border border-green-600 py-2 px-4 rounded-md mt-1 font-semibold hover:bg-green-600 hover:text-white ">
                My Documents
        </div>

        <div class="border border-green-600 py-2 px-4 rounded-md mt-1 font-semibold hover:bg-green-600 hover:text-white">
                Track Documents
        </div>
    </section>

    <section class="py-8 mt-2">
            <div class="text-lg font-semibold text-gray-600 border-b border-gray-200 ">
                 Notifications
            </div>
    </section>
    <section class="py-8 mt-2">
            <div class="text-lg font-semibold text-gray-600 border-b border-gray-200 ">
                Recent Documents
            </div>
    </section>
    
</div>

</x-staff-layout>