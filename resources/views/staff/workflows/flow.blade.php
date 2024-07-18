<x-staff-layout>

    <div class="flex flex-col container mx-4 border border-0 md:mx-auto">
        <section class="border-b border-gray-200 py-2 mt-2">
                <div class="text-2xl font-semibold ">
                    Workflow            
                </div>
                
        </section>
    
        @include('partials._document_submenu1')


        <section class="py-8 mt-2">

            <div class="flex flex-col md:flex-row w-full space-y-4 md:space-y-0 md:space-x-4 ">
                    <!-- left panel //-->
                    <div class="flex flex-col w-full md:w-3/5 border border-1 rounded-md py-2 px-4">
                            <div class="border-b border-1 py-2">
                                    <div class="font-semibold">
                                        {{ $document->title}}
                                    </div>
                                    <div class="flex flex-col md:flex-row border border-0 justify-between md:items-center ">

                                        <div class="text-xs">
                                            Submitted by {{ $document->staff->surname}} {{ $document->staff->firstname}} @ {{ $document->created_at->format('l jS F, Y  g:i a') }}
                                        </div>

                                       
                                        
                                    </div>
                            </div>
                            <div class="flex flex-row text-sm py-4 justify-content items-start">
                                        <div class="flex flex-col w-1/5">
                                                <a href="{{ asset('storage/'.$document->document) }}" target="_blank" 
                                                        class="px-6 py-6 text-center border border-1 hover:bg-blue-100 
                                                            rounded-md hover:border-blue-100 justify-center">
                                                        <div class="flex justify-center">
                                                                @if ($document->filetype == "MS Word")
                                                                <img src="{{ asset('images/icon_doc_50.jpg') }}"  />
                                                                @elseif ($document->filetype == "PDF")
                                                                <img src="{{ asset('images/icon_pdf_50.jpg') }}" />
                                                                @elseif ($document->filetype == "Image | jpg")
                                                                <img src="{{ asset('images/icon_image_50.jpg') }}"/>
                                                                @endif
                                                        </div>

                                                        <div class="">
                                                                {{ $document->filetype }}
                                                        </div>
                                                        <div class="text-xs">
                                                                {{ $document->filesize }}
                                                        </div>
                                                </a>
                                        </div>
                                        <div class="px-4 py-2 border border-0 w-full">
                                                @if ($document->comment=='')
                                                    No Comment

                                                @else
                                                    {{ $document->comment }}
                                                @endif 

                                                <!-- workflow start or continue //-->
                                                <div class="flex flex-col md:flex-row py-4">

                                                    <!-- forward to contributor //-->
                                                    <div class="flex flex-col flex-1">
                                                            <div class="font-semibold py-2">Forward to</div>

                                                            <form>
                                                                <!-- Contributor panel //-->
                                                                <div class="flex flex-col md:flex-row w-full border border-0">
                                                                    <!-- Select List to Contributors //-->
                                                                    <div class="flex flex-col border-red-900 w-[97%] md:w-[72%] py-2">                                                                            
                                                                            
                                                                            <select name="contributor" class="border border-1 border-gray-400 bg-gray-50
                                                                                                                    w-full py-1 px-2 rounded-md 
                                                                                                                    focus:outline-none
                                                                                                                    focus:border-blue-500 
                                                                                                                    focus:ring
                                                                                                                    focus:ring-blue-100"                                                                                                                                                                                                                                                                                                                                                
                                                                                                                    
                                                                                                                    style="font-family:'Lato';font-size:16px;font-weight:500;"
                                                                                                                    required
                                                                                                                    >
                                                                                                                    <option value=''>-- Select Contributor --</option>
                                                                                                                                                                                            
                                                                            </select>

                                                                            @error('contributor')
                                                                                <span class="text-red-700 text-sm">
                                                                                    {{$message}}
                                                                                </span>
                                                                            @enderror
                                                                        
                                                                    </div>                                                                
                                                                    <!-- end of List of Contributors //-->



                                                                    <!-- Add contributor //-->
                                                                    <div class="flex flex-col justify-center border border-0 md:items-center md:px-2 py-2 ">
                                                                                            
                                                                                    <div>
                                                                                        <a href="{{ route('staff.workflows.add_contributor', ['document'=>$document->id])}}" class="border border-1
                                                                                            rounded-md py-2 px-4 text-xs text-green-500 border-green-500 hover:bg-green-500 hover:text-white font-semibold">
                                                                                            Add Contributor
                                                                                        </a>
                                                                                    </div>

                                                                    </div>
                                                                    <!-- end of Add contributor //-->

                                            
                                                                </div>                                                            
                                                                <!-- end of contributor panel //-->




                                                                    <div id='status_comment_panel' style="display:none;"><!-- group div for status and comment //-->

                                                                            <!-- Select Status //-->
                                                                            <div class="flex flex-col border-red-900 w-[97%] md:w-[95%] py-2">                                                                            
                                                                                    
                                                                                <select name="status" class="border border-1 border-gray-400 bg-gray-50
                                                                                                                        w-full px-2 py-1 rounded-md 
                                                                                                                        focus:outline-none
                                                                                                                        focus:border-blue-500 
                                                                                                                        focus:ring
                                                                                                                        focus:ring-blue-100"                                                                                                                                                                                                                                                                                                                                                
                                                                                                                        
                                                                                                                        style="font-family:'Lato';font-size:16px;font-weight:500;"
                                                                                                                        required
                                                                                                                        >
                                                                                                                        <option value=''>-- Select Status --</option>
                                                                                                                        <option value='approved'>Approved </option>
                                                                                                                        <option value='unapproved'>Not Approved </option>
                                                                                                                                                                                                
                                                                                </select>

                                                                                @error('status')
                                                                                    <span class="text-red-700 text-sm">
                                                                                        {{$message}}
                                                                                    </span>
                                                                                @enderror
                                                                            
                                                                            </div>                                                                
                                                                            <!-- end of Status //-->


                                                                            <!-- Comment //-->
                                                                            <div class="flex flex-col border-red-900 w-[80%] md:w-[95%] py-1">
                                                                            
                                                                                
                                                                                <textarea name="comment" class="border border-1 border-gray-400 bg-gray-50
                                                                                                                        w-full p-4 rounded-md 
                                                                                                                        focus:outline-none
                                                                                                                        focus:border-blue-500 
                                                                                                                        focus:ring
                                                                                                                        focus:ring-blue-100" 
                                                                                                                        
                                                                                                                        value="{{ old('comment') }}"
                                                                                                                        
                                                                                                                        style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                     
                                                                                                                        maxlength="140"
                                                                                                                        >  </textarea>
                                                                                                                        <div class="text-xs text-gray-600">Comment (140 words)</div>
                                                                                                                                                                                            

                                                                                                                        @error('comment')
                                                                                                                            <span class="text-red-700 text-sm">
                                                                                                                                {{$message}}
                                                                                                                            </span>
                                                                                                                        @enderror
                                                                                
                                                                            </div><!-- end of comment //-->


                                                                            <!-- submit button //-->

                                                                            <button class="border border-1 border-green-500
                                                                                bg-green-500 text-white rounded-md py-2 px-4 text-xs font-semibold mt-1">
                                                                                Send
                                                                            </button>
                                                                            <!-- end of submit button //-->


                                                                    </div><!-- end of group div for status and comment //-->









                                                                

                                                                



                                                            </form>
                                                            <!-- end of forward button //-->



                                                    </div>
                                                    <!-- end of forward to contributor //-->

                                                    

                                                        
                                                </div>
                                        </div>
                            </div>

                    </div>
                    <!-- end of left panel //-->

                    <!-- right panel //-->
                    <div class="w-full md:w-2/5 md:flex-grow border border-1 py-4 px-4 rounded-md">
                            <div class="font-semibold text-gray-500">
                                    Workflow Participants
                            </div>
                    </div>
                    <!-- end of right panel //-->
            </div>
             
        </section>
        
    </div>
    
    </x-staff-layout>