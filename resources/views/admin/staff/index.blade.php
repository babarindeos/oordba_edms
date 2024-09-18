<x-admin-layout>
    <div class="container border-0 mx-auto">
        <!-- page header //-->
        <section class="flex flex-col w-[95%] md:w-[95%] py-1 mt-6 px-4 border-red-900 mx-auto">
        
            <div class="flex border-b border-gray-300 py-2 justify-between">
                    <div class="flex flex-row w-1/4">
                        <h1 class="text-2xl font-semibold font-serif text-gray-800">Staff</h1>
                    </div>
                    <div class="flex flex-row w-3/4 justify-end space-x-1">

                            <form action="{{ route('admin.staff.select_organ') }}" method="POST" class="flex flex-row w-full justify-end space-x-1">
                                @csrf
                                <!-- Select Organ //-->
                                <div class="flex flex-col border-red-900 w-[60%] md:w-[40%] py-2">
                                        
                                        
                                    <select name="organ" class="border border-gray-400 bg-gray-50
                                                                            w-full p-1 px-2 rounded-md 
                                                                            focus:outline-none
                                                                            focus:border-blue-500 
                                                                            focus:ring
                                                                            focus:ring-blue-100"
                                                                            
                                                                            
                                                                            style="font-family:'Lato';font-size:16px;font-weight:500;"
                                                                            required
                                                                            >
                                                                            <option value=''>-- Select Organ --</option>
                                                                                    <option value="1">Directorate</option>
                                                                                    <option value="2">Department</option>
                                                                                    <option value="3">Division</option>
                                                                                    <option value="4">Branch</option>
                                                                                    <option value="5">Section</option>
                                                                                    <option value="6">Unit</option>                                                              
                                                                            </select>

                                                                            @error('organ')
                                                                                <span class="text-red-700 text-sm">
                                                                                    {{$message}}
                                                                                </span>
                                                                            @enderror
                                    
                                </div>                        
                                <!-- end of Organ Select //-->

                                <div class="border-0 flex flex-col items-center justify-center">
                                        <button type="submit" class="bg-green-600 text-white py-2 px-4 
                                                rounded-lg text-sm hover:bg-green-500">New Staff</button>
                                </div>
                            </form>
                    </div>
            </div>
        </section>
        <!-- end of page header //-->

        @if ($staffs->count())
                <section class="flex flex-col py-2 px-2 justify-end w-[93%] mx-auto md:px-1">
                    <div class="flex justify-end border border-0">
                    
                        <input type="text" name="search" class="w-4/5 md:w-2/5 border border-1 border-gray-400 bg-gray-50
                                    p-2 rounded-md 
                                    focus:outline-none
                                    focus:border-blue-500 
                                    focus:ring
                                    focus:ring-blue-100" placeholder="Search"                
                                
                                    style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                  
                        
                        />  
                    </div>
                    
                </section>
                <section class="flex flex-col w-[95%] md:w-[95%] mx-auto px-4">
                    <table class="table-auto border-collapse border border-1 border-gray-200" 
                                >
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="text-center font-semibold py-2 w-16">SN</th>
                                <th class="font-semibold py-2 text-left">Staff No</th>
                                <th class="font-semibold py-2 text-left">Full name</th>                    
                                <th class="font-semibold py-2 text-left">Segment</th>
                                <th class="font-semibold py-2 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                                @php 
                                    $counter = 0;
                                    
                                    $counter = ($staffs->currentPage() - 1 ) * $staffs->perPage();
                                
                                @endphp

                                @foreach ($staffs as $staff)
                                    <tr class="border border-b border-gray-200 ">
                                        <td class='text-center py-4'>{{ ++$counter }}.</td>
                                        <td>{{ $staff->fileno }}</td>
                                        <td>{{ $staff->surname }} {{ $staff->firstname }} {{ $staff->middlename }}</td>

                                        <td>{{ $staff->segment->name }}</td>
                                        <td class="text-center">
                                            <span class="px-1">
                                                <a class="bg-green-400 hover:bg-green-500 text-white rounded-md px-4 py-1 text-xs"
                                                    href="{{ route('admin.profile.user_profile', ['fileno'=> $staff->fileno])}}">
                                                    View
                                                </a>
                                            </span>
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

                    <div class="py-2">
                        {{ $staffs->links() }}
                    </div>
                </section>
        @else
                <section class="flex flex-col w-[95%] md:w-[95%] mx-auto px-4">
                    <div class="flex flex-row text-2xl font-semibold text-gray-300 justify-center py-8">
                        No Staff record is found
                    </div>
                </section>
        @endif
    </div>
</x-admin-layout>

<script>
    $(document).ready(function(){
        $("input[name='search']").on('keyup', function(){
            var value = $(this).val().toLowerCase();

            $("table tbody tr").filter(function(){
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            })
        });
    });

</script>