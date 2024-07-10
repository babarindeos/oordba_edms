@if (session('error'))

            @if (session('status')=='success')
                <span class="flex flex-col w-[80%] md:w-[60%] py-4 px-2 my-2 bg-green-50 rounded text-green-800 font-medium" 
                        style="font-family:'Lato'; font-size:16px;"> 
                    {{ session('message') }}
                </span>
            @else
                <span class="flex flex-col w-[80%] md:w-[60%] py-4 px-2 my-2 bg-red-50 rounded text-red-800 font-medium" 
                        style="font-family:'Lato'; font-size:16px;">
                    {{ session('message') }}
                </span>
            @endif

@endif