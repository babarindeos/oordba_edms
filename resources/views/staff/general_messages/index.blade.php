<x-staff-layout>

    <div class="flex flex-col container mx-4 border border-0 md:mx-auto">
        <section class="border-b border-gray-200 py-2 mt-2">
                <div class="text-2xl font-semibold ">
                    General Message              
                </div>
                
        </section>
    
        <section>
                <div class="flex">
                        <a onclick="history.back();" class="border px-4 py-1 mt-1 cursor-pointer 
                                                            hover:font-semibold hover:border-gray-300">    
                                &laquo; Back
                        </a>
                </div>
        </section>


        <section class="py-2 mt-2">
            <div class="flex flex-col md:flex-row border-0">
                <div class="flex  md:w-[30%] border-0 px-2 py-2 overflow-y-auto h-100 mr-2"><!-- left panel //-->
                        
                    
                        <!-- Workflow Contributors //-->
                        <div class="w-full mt-2">
                            @foreach($workflow_contributors as $contributor)
                                <div class="w-full py-1">
                                        <div class="flex flex-row w-full text-sm border-b ">
                                                <div class="flex flex-col justify-center px-2 py-2 items-center">
                                                        <img class="w-12" src="{{ asset('images/avatar_64.jpg')}}" />                                                                
                                                </div>
                                                <div class="flex flex-col py-2 w-full">
                                                    <div class="font-bold">{{ $contributor->user->staff->surname}}  {{ $contributor->user->staff->firstname}}</div>
                                                    <div>{{ $contributor->user->staff->department->department_name}}  ({{ $contributor->user->staff->department->department_code}})</div>
                                                    <div>{{ $contributor->user->staff->department->ministry->name}} ({{ $contributor->user->staff->department->ministry->code}})</div>
                                                    <div class="w-full">
                                                        @if (Auth::user()->id != $contributor->user_id)
                                                            <div class="flex text-end justify-end "> 
                                                                <a href="{{ route('staff.workflows.private_message.index', ['document'=>$document->id, 'recipient'=>$contributor->user_id]) }}" class="flex text-xs border border-1 border-green-500 px-2 py-1 rounded-md 
                                                                        hover:bg-green-500 hover:text-white">   
                                                                    Message
                                                                </a>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                        </div>
                                </div>
                            @endforeach
                        </div>
                        <!-- end of workflow contributors //-->


                </div><!-- end of left pane //-->


                <div class="flex flex-col border-l  md:w-[60%] px-3 py-2"><!-- Right pane //-->
                    <form action="{{ route('staff.workflows.general_message.store',['document'=>$document->id]) }}" method="POST">
                            @csrf
                            <!-- textarea //-->
                            <div class="flex items-center py-1">
                                    <textarea name="message" rows="3" class="overflow-hidden border border-1 border-gray-400 bg-gray-50
                                            w-full p-1 py-2 rounded-md 
                                            focus:outline-none
                                            focus:border-blue-500 
                                            focus:ring
                                            focus:ring-blue-100" 
                                            
                                            value="{{ old('message') }}"
                                            
                                            style="font-family:'Lato';font-size:16px;font-weight:500;"                                                                     
                                            maxlength="140">  </textarea>
                            </div>
                            <!-- end of textarea //-->

                            <!-- button //-->
                            <div class="flex justify-between">

                                <div class="flex text-xs text-gray-500">
                                    140 characters max
                                </div>
                                
                                <div>    
                                    <button type="submit" class="border border-1 border-green-500
                                    bg-green-500 text-white rounded-md py-2 px-4 text-xs font-semibold">
                                            Send
                                    </button>
                                </div>
                            </div>
                            <!-- end of button //-->
                    </form>



                    <!-- list of messages //-->
                    <div class="flex flex-col border-0 border-blue-900 h-50 overflow-y-auto py-2 mt-2">
                            
                        @foreach ($messages as $message)
                            <div class="flex flex-row my-2">
                                    <div class="px-3 border-0">
                                            <img class="w-12" src="{{ asset('images/avatar_64.jpg')}}" />  
                                    </div>
                                    <div class="px-3 py-1 rounded-md bg-gray-100 w-full">
                                            <div class="font-semibold text-sm">
                                                    {{ $message->sender->surname }} {{ $message->sender->firstname }}
                                            </div>
                                            <div class="text-xs">
                                                    {{ $message->created_at->format('l jS F, Y @ g:i a') }}
                                            </div>
                                            <div class="text-sm py-2">
                                                    {{ $message->message}}
                                            </div>

                                    </div>
                            </div>
                        @endforeach

                    </div>
                    <!-- end of list of messages //-->
                                                                                

                </div><!-- end of right panel //-->
            </div>             
        </section>
        
    </div>
    
    </x-staff-layout>