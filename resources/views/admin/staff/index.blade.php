<x-admin-layout>
    <div class="container">
        <!-- page header //-->
        <section class="flex flex-col w-[95%] md:w-[95%] py-8 px-4 border-red-900 mx-auto">
        
            <div class="flex border-b border-gray-300 py-2 justify-between">
                    <div >
                        <h1 class="text-2xl font-semibold font-serif text-gray-800">Staff</h1>
                    </div>
                    <div>
                            <a href="{{ route('admin.staff.create') }}" class="bg-green-600 text-white py-2 px-4 
                                            rounded-lg text-sm hover:bg-green-500">New Staff</a>
                    </div>
            </div>
        </section>
        <!-- end of page header //-->

        <section class="flex flex-col w-[95%] md:w-[95%] mx-auto px-4">
            <table class="table-auto border-collapse border border-1 border-gray-200" 
                        >
                <tr class="bg-gray-200">
                    <td class="text-center font-semibold py-2 w-16">SN</td>
                    <td class="font-semibold py-2">Staff No</td>
                    <td class="font-semibold py-2">Full name</td>
                    <td class="font-semibold py-2">College</td>
                    <td class="font-semibold py-2">Department</td>
                    <td class="font-semibold py-2 text-center">Action</td>
                </tr>
                <tbody>
                        @php 
                            $counter = 0;
                        @endphp

                        @foreach ($staffs as $staff)
                            <tr class="border border-b border-gray-200 ">
                                <td class='text-center py-4'>{{ ++$counter }}.</td>
                                <td>{{ $staff->staff_no }}</td>
                                <td>{{ $staff->surname }} {{ $staff->firstname }} {{ $staff->middlename }}</td>
                                <td>{{ $staff->college->college_code }}</td>
                                <td>{{ $staff->department->department_code }}</td>
                                <td class="text-center">
                                    <span class="text-sm">
                                        <a class="hover:bg-blue-500 bg-blue-400 text-white rounded-md 
                                                px-4 py-1 text-xs" href="{{ route('admin.staff.edit', ['staff' => $staff->id]) }}">Edit</a>
                                    </span>
                                    <span> 
                                        <a class="hover:bg-red-500 bg-red-400 text-white rounded-md 
                                                px-4 py-1 text-xs" href="#"
                                        href=''>Delete</a>
                                    </span>	
                                </td>
                            </tr>
                        @endforeach
                </tbody>

            </table>


        </section>
    </div>
</x-admin-layout>