<x-staff-layout>
    <div class="flex flex-col container mx-4 md:mx-auto">
        <section class="border-b border-gray-200 py-2 mt-2">
                <div class="text-2xl font-semibold ">
                    User Profile              
                </div>                
        </section>

        @if ( $userprofile == null)
            <section class="mx-auto">
                    <div class="flex flex-col justify-content items-center  py-12">
                        <div class="text-2xl text-gray-400 font-bold">Oops! An error occurred</div>
                        <div class="text-lg font-semibold">Sorry, there is no such record </div>
                    </div>
            </section>
        
        @elseif ($userprofile->user->profile == null)
            
            <section class="mx-auto">
                    <div class="flex flex-col justify-content items-center  py-12">
                        <div class="text-2xl text-gray-400 font-bold">Oops! An error occurred</div>
                        <div class="text-lg font-semibold">Sorry, the user has not created profile for the account </div>
                    </div>
            </section>
        @else

                <section class="flex flex-col md:flex-row rounded w-full mt-3 space-x-4">
                    <div class="flex flex-col w-full  md:w-[30%] justify-center items-center 
                                border px-8 py-4 rounded-md">
                            <div class="">
                                @if ($userprofile->user->profile!=null && ($userprofile->user->profile->avatar != "" || $userprofile->user->profile->avatar != null))
                                    <img src="{{ asset('storage/'.$userprofile->user->profile->avatar) }}" class="w-36 h-36 rounded-full" />
                                @else
                                    <img src="{{ asset('images/avatar_150.jpg') }}" />
                                @endif
                            </div>
                            

                    </div>
                    <div class="flex flex-col justify-center md:border rounded-md md:w-[70%] py-4 px-4">
                            
                            <div class="mb-4  mx-[10%] md:mx-0 ">
                                    <div class="text-xl font-semibold">
                                            {{ $userprofile->user->surname }} {{ $userprofile->user->firstname }} {{ $userprofile->user->middlename }}                                
                                    </div>
                                    <div class="text-sm">
                                            {{ $userprofile->user->profile->designation}}, {{ $userprofile->user->staff->fileno}}
                                    </div>                            
                            </div>


                            <div class="py-4 mx-[10%] md:mx-0">
                                    <div>
                                            {{ $organ->name}} ({{ $organ->code}})
                                    </div>
                                    <div>
                                            {{ $userprofile->segment->name }} 
                                    </div>                            
                            </div>


                            <div class="py-4 mx-[10%] md:mx-0">
                                    <div>
                                            {{ $userprofile->user->email }}
                                    </div>
                                    <div>
                                            {{ $userprofile->user->profile->phone}}
                                    </div>

                            </div>
                    </div>
                </section>

    @endif
    


    </div>

</x-staff-layout>