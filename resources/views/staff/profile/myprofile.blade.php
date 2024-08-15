<x-staff-layout>

    <div class="flex flex-col container mx-4 md:mx-auto">
        <section class="border-b border-gray-200 py-2 mt-2">
                <div class="text-2xl font-semibold ">
                    My Profile              
                </div>                
        </section>

        <section class="flex flex-col md:flex-row rounded w-full mt-3 space-x-4">
            <div class="flex flex-col w-full  md:w-[30%] justify-center items-center 
                        border px-8 py-4 rounded-md">
                    <div class="">
                        <img src="{{ asset('images/avatar_150.jpg') }}" />
                    </div>
                    <div class="mt-2">
                        <form enctype="multi-part/form-data" class="flex flex-col items-center">
                            <input type="file" class="text-sm border-0 border-gray-500
                                                     items-center 
                                                     justify-center w-3/5" />

                            <div class="py-2">
                                    <button type="submit" class="px-4 py-1 text-sm 
                                                         rounded-md border border-gray-500 ring-0 
                                                         ring-cyan-500
                                                         hover:shadow-md hover:font-semibold bg-gray-100 ">Update Avatar</button>
                            </div>
                        </form>
                    </div>

            </div>
            <div class="flex flex-col justify-center md:border rounded-md md:w-[70%] py-2 px-4">
                    <div class="flex justify-end px-4">
                            <a href="#" class="border px-4 py-1 rounded-md ring-0 
                                 border-gray-500 bg-gray-100 hover:shadow-md text-sm">
                                Edit
                            </a>
                    </div>
                    <div class="mb-4  mx-[10%] md:mx-0 ">
                            <div class="text-xl font-semibold">
                                    {{ Auth::user()->surname }} {{ Auth::user()->firstname }} {{ Auth::user()->middlename }}                                
                            </div>
                            <div class="text-sm">
                                    {{ Auth::user()->profile->designation}}, {{ Auth::user()->staff->fileno}}
                            </div>                            
                    </div>


                    <div class="py-4 mx-[10%] md:mx-0">
                            <div>
                                    {{ Auth::user()->staff->department->ministry->name}} ({{ Auth::user()->staff->department->ministry->code}})
                            </div>
                            <div>
                                    {{ Auth::user()->staff->department->department_name }} ({{ Auth::user()->staff->department->department_code}})
                            </div>                            
                    </div>


                    <div class="py-4 mx-[10%] md:mx-0">
                            <div>
                                    {{ Auth::user()->email }}
                            </div>
                            <div>
                                    {{ Auth::user()->profile->phone}}
                            </div>

                    </div>
            </div>
        </section>
    


    </div>


</x-staff-layout>