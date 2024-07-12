<x-staff-layout>

    <div class="flex flex-col container mx-4 border border-0 md:mx-auto">
        <section class="border-b border-gray-200 py-2 mt-2">
                <div class="text-2xl font-semibold ">
                    Documents               
                </div>
                
        </section>
    
        <section class="flex flex-col md:flex-row md:space-x-4">
            <div class="border border-green-600 py-2 px-4 rounded-md mt-1 font-semibold 
                        hover:bg-green-600 hover:text-white hover:shadow-md">
                    My Documents
            </div>
    
            <div class="border border-green-600 py-2 px-4 rounded-md mt-1 font-semibold 
                            hover:bg-green-600 hover:text-white hover:shadow-md">
                    Track Documents
            </div>

            <a href="{{ route('staff.documents.create') }}" class="border border-green-600 py-2 px-4 rounded-md mt-1 font-semibold 
                             hover:bg-green-600 hover:text-white hover:shadow-md">
                Upload Document
            </a>
        </section>
    
        <section class="py-8 mt-2">
             
        </section>
        
    </div>
    
    </x-staff-layout>