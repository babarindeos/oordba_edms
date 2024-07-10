<x-admin-layout>
    <div class="container">
        <!-- page header //-->
        <section class="flex flex-col w-[95%] md:w-[95%] py-8 px-4 border-red-900 mx-auto">
        
            <div class="flex border-b border-gray-300 py-2 justify-between">
                    <div >
                        <h1 class="text-2xl font-semibold font-serif text-gray-800">Ministries</h1>
                    </div>
                    <div>
                            <a href="{{ route('admin.colleges.create') }}" class="bg-green-600 text-white py-2 px-4 
                                            rounded-lg text-sm hover:bg-green-500">New Ministry</a>
                    </div>
            </div>
        </section>
        <!-- end of page header //-->

        <section class="flex flex-col w-[95%] md:w-[95%] mx-auto px-4">
            <table class="table-auto border-collapse border border-1 border-gray-200" 
                        >
                <tr class="bg-gray-200">
                    <td class="text-center font-semibold py-2 w-16">SN</td>
                    <td class="font-semibold py-2">Ministry Name</td>
                    <td class="font-semibold py-2">Ministry Code</td>
                    <td class="font-semibold py-2 text-center">Action</td>
                </tr>
                <tbody>
                    @php
                        $counter = 0;
                    @endphp
                    
                </tbody>

            </table>


        </section>
    </div>
</x-admin-layout>