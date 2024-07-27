<x-staff-layout>

    <div class="flex flex-col container mx-4 border border-0 md:mx-auto">
        <section class="border-b border-gray-200 py-2 mt-2">
                <div class="text-2xl font-semibold ">
                    Documents               
                </div>
                
        </section>
    
        @include('partials._document_submenu1')
        

        <section class="flex flex-col py-1  mt-4 justif-end">
            <div class="flex justify-end border border-0">
            
                <input type="text" name="document_title" class="w-3/5 md:w-2/5 border border-1 border-gray-400 bg-gray-50
                            p-2 rounded-md 
                            focus:outline-none
                            focus:border-blue-500 
                            focus:ring
                            focus:ring-blue-100" placeholder="Search"                
                          
                            style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                  
                
                />  
            </div>
             
        </section>

        <section class="flex flex-col py-2 ">
            <table class="table-auto border-collapse border border-1 border-gray-200" 
                        >
                <tr class="bg-gray-200">
                    <td class="text-center font-semibold py-2 w-16">SN</td>
                    <td class="font-semibold py-2">Documents</td>
                    <td class="font-semibold py-2">Date Created</td>
                    
                </tr>
                <tbody>
                    @php
                        $counter = ($documents->currentPage() - 1) * $documents->perPage();
                    @endphp
                    @foreach($documents as $doc)
                        <tr class="border border-b border-gray-200 ">
                            <td class='text-center py-4'>{{ ++$counter }}.</td>
                            <td class="py-2 pr-4">
                                
                                <div>
                                    <a href="{{ route('staff.workflows.flow', ['document'=>$doc->document->id]) }}" class='text-blue-500 underline font-semibold' href=''>
                                        {{ $doc->document->title }}
                                    </a>
                                </div>
                                <div class='flex flex-col space-y-1 md:flex-row justify-between text-xs'>
                                    <div class="flex flex-col">
                                            <div class="flex flex-row space-x-2">
                                                <div>{{ $doc->document->filetype }} ({{ $doc->document->filesize }})</div>
                                                <div>{{ $doc->document->owner->surname }} {{ $doc->document->owner->firstname }}</div>
                                            </div>
                                            <div class="flex flex-col md:flex-row space-y-1 py-1 md:space-x-8 md:space-y-0">
                                                @if ($doc->document->workflows->count())
                                                    <a class="hover:underline cursor-pointer" href="{{ route('staff.workflows.flow', ['document'=>$doc->document->id]) }}" > 
                                                        Workflow ({{ $doc->document->workflows->count() }})
                                                    </a>
                                                @endif

                                                @if ($doc->document->general_messages->count())
                                                    <a href="{{ route('staff.workflows.general_message', ['document'=>$doc->document->id]) }}" class="hover:underline cursor-pointer">
                                                            General Messages ({{ $doc->document->general_messages->count() }})
                                                    </a>
                                                @endif

                                                
                                                    

                                                @if ($doc->document->private_messages->count())
                                                    <a href="{{ route('staff.workflows.private_messages.my_private_messages', ['document'=>$doc->document->id, 'recipient'=>$doc->user_id])}}">
                                                        Private Messages ({{ $doc->document->private_messages->count() }})
                                                    </a>
                                                @endif
                                            </div>
                                    </div>
                                    <div class="md:px-4 border border-0">
                                        <!--
                                        <span class="px-2 py-1 rounded-md" style="background-color: #daf1e6;">
                                           {{ $doc->document->uuid }} 
                                        </span>
                                        //-->
                                    </div>
                                </div>
                            
                            </td>
                            <td width="20%" class="text-sm">
                                    <div class="px-0">
                                        {{ $doc->document->created_at->format('l jS F, Y @ g:i a')}}
                                    </div>
                            </td>
                            
                        </tr>
                    @endforeach
                    
                </tbody>

            </table>

            {{ $documents->links() }}


        </section>
        
    </div>
    
    </x-staff-layout>