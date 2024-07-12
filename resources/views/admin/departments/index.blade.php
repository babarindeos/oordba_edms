<x-admin-layout>
    <div class="container">
        <!-- page header //-->
        <section class="flex flex-col w-[95%] md:w-[95%] py-8 px-4 border-red-900 mx-auto">
        
            <div class="flex border-b border-gray-300 py-2 justify-between">
                    <div >
                        <h1 class="text-2xl font-semibold font-serif text-gray-800">Departments & Agencies</h1>
                    </div>
                    <div>
                            <a href="{{ route('admin.departments.create') }}" class="bg-green-600 text-white py-2 px-4 
                                            rounded-lg text-sm hover:bg-green-500">New Department & Agency</a>
                    </div>
            </div>
        </section>
        <!-- end of page header //-->

        @if (count($departments) > 0)
                <section class="flex flex-col w-[95%] md:w-[95%] mx-auto px-4">
                    <table class="table-auto border-collapse border border-1 border-gray-200" 
                                >
                        <tr class="bg-gray-200">
                            <td class="text-center font-semibold py-2 w-16">SN</td>
                            <td class="font-semibold py-2">Ministry</td>
                            <td class="font-semibold py-2">Department Name</td>
                            <td class="font-semibold py-2">Department Code</td>
                            <td class="font-semibold py-2 text-center">Action</td>
                        </tr>
                        <tbody>
                            @php
                                $counter = ($departments->currentPage() -1 ) * $departments->perPage();
                            @endphp

                                @foreach ($departments as $department)
                                <tr class="border border-b border-gray-200">
                                    <td class='text-center py-4'>{{ ++$counter }}.</td>
                                    <td>{{ $department->ministry->name }} <br/><small>({{$department->ministry->code}})</small></td>
                                    <td>{{ $department->department_name }}</td>
                                    <td>{{ $department->department_code }}</td>
                                    <td class="text-center">
                                        <span class="text-sm">
                                            <a class="hover:bg-blue-500 bg-blue-400 text-white rounded-md 
                                                    px-4 py-1 text-xs" href="{{ route('admin.departments.edit', ['department'=>$department->id])}}">Edit</a>
                                        </span>
                                        <span> 
                                            <a class="hover:bg-red-500 bg-red-400 text-white rounded-md 
                                                    px-4 py-1 text-xs" href="{{ route('admin.departments.destroy', ['department'=>$department->id])}}"
                                            >Delete</a>
                                        </span>
                                    </td>

                                </tr>
                                @endforeach
                            
                            
                        </tbody>

                    </table>

                    <div class="mt-1">
                        {{ $departments->links() }}

                    </div>


                </section>
        @else
                <section class="flex flex-col w-[95%] md:w-[95%] mx-auto px-4">
                        No Department or Agency
                </section>
        @endif
        
        
    </div>
</x-admin-layout>