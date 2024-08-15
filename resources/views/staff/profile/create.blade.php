<x-guest-layout>

    <div class="flex flex-col border border-1 md:w-1/3 mx-auto items-center justify-center rounded-md mt-8 mb-8 shadow-md">
        <form name="profile_create" action="{{ route('staff.profile.store') }}" method="POST"  enctype="multipart/form-data" class="flex flex-col border border-1 justify-center items-center w-full">
            @csrf
            <div class="flex flex-col py-2 justify-center items-center font-semibold text-xl">
                    Create Profile
            </div>
            <div class="flex flex-row justify-center">
                    
                    @if ($profile==null)
                    <img src="{{ asset('images/avatar_150.jpg')}}" class="w-150" />
                    @else
                        <img src="{{ asset('storage/'.$profile->avatar) }}" class="w-36 h-36 rounded-full" />
                    @endif
                    
            </div>
            
            <!-- file upload //-->
            <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] py-1">
                                
                                
                <input type="file" name="avatar" id="avatar" class="border border-1 border-gray-400 bg-gray-50
                                                         w-full p-3 rounded-md 
                                                         focus:outline-none
                                                         focus:border-blue-500 
                                                         focus:ring
                                                         focus:ring-blue-100" 
                  
                 style="font-family:'Lato';font-size:16px;font-weight:500;"
                 accept=".jpg, .jpeg, .png"
                 />
                    

                 @error('avatar')
                    <span class="text-red-700 text-sm">
                        {{$message}}
                    </span>
                 @enderror
                
            </div>
           <!-- end of file upload //-->


            <!-- designation  //-->
            <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] py-1">
                                    
                                    
                <input type="text" name="designation" placeholder="Designation" class="border border-1 border-gray-400 bg-gray-50
                                                        w-full p-3 rounded-md 
                                                        focus:outline-none
                                                        focus:border-blue-500 
                                                        focus:ring
                                                        focus:ring-blue-100" 
                @if ($profile!=null)  value="{{$profile->designation}} " @endif
                style="font-family:'Lato';font-size:16px;font-weight:500;"   
                required          
                 />
                    

                @error('designation')
                    <span class="text-red-700 text-sm">
                        {{$message}}
                    </span>
                @enderror
                
            </div>
            <!-- end of designation //-->


            <!-- phone  //-->
            <div class="flex flex-col border-red-900 w-[80%] md:w-[60%] py-1">
                                    
                                    
                <input type="text" name="phone" placeholder="Phone Number" class="border border-1 border-gray-400 bg-gray-50
                                                        w-full p-3 rounded-md 
                                                        focus:outline-none
                                                        focus:border-blue-500 
                                                        focus:ring
                                                        focus:ring-blue-100" 
                @if ($profile!=null) value="{{ $profile->phone }}" @endif
                style="font-family:'Lato';font-size:16px;font-weight:500;"             
                required/>
                    

                @error('phone')
                    <span class="text-red-700 text-sm">
                        {{$message}}
                    </span>
                @enderror
                
            </div>
            <!-- end of phone //-->


            <!-- button //-->
            <div class="flex flex-row border-red-900 w-[80%] md:w-[60%] py-2 mb-2 space-x-2">
                <div class="flex flex-1 w-full border border-1">
                    <button type="submit" class="w-full border border-1 bg-gray-400 py-4 text-white 
                                hover:bg-gray-500
                                rounded-md text-md" style="font-family:'Lato';font-weight:500;">Create Profile</button>
                </div>
                
                @if ($profile!=null)
                    <div class="flex border border-1">
                            <a href="{{ route('staff.dashboard.index') }}" class="w-full border border-1 bg-green-400 py-4 px-4 text-white 
                                 hover:bg-green-500 rounded-md text-md" style="font-family:'Lato';font-weight:500;">Continue</a>
                    </div>
                @endif
            </div>



        <!-- end of buttons //-->



        </form>


    </div>


</x-guest-layout>

