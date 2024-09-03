<x-staff-layout>

<div class="flex flex-col container mx-4 border border-0 md:mx-auto">
    <section class="border-b border-gray-200 py-2 mt-2">
            <div class="text-2xl font-semibold ">
                Dashboard                
            </div>
            <div>
                @if (Auth::check())
                    Welcome {{ Auth::user()->surname }} {{ Auth::user()->firstname}}
                @endif
            </div>
    </section>

    @include('partials._document_submenu1')


    <div class="flex flex-col md:flex-row space-x-4">
        

        @if (count($workflow_notifications) > 0 )
        <div class="md:flex-1 border-0">
            <section class="py-8 mt-2">
                    <div class="text-lg font-semibold text-gray-600 border-b border-gray-200 ">
                        Workflow Notifications ({{ $workflow_notifications->count() }})
                    </div>
                    <div>
                        <ul class="list-disc px-10">
                            @foreach ($workflow_notifications as $notification)
                                <li class="py-3 border-b border-gray-100">
                                    <a title="{{ $notification->document->title }}" class="hover:underline" href="{{ route('staff.workflows.notification_update', ['workflow'=>$notification->id])}}" >
                                    
                                        <div class="font-medium text-gray-700">
                                            {{$notification->document->title}}
                                        </div>
                                        <div class="text-xs">
                                            from {{ $notification->sender->surname}} @ 
                                            {{ $notification->created_at->format('l jS F, Y g:i a')}}
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                        <div class="py-2">
                                {{ $workflow_notifications->links() }}
                        </div>

                    </div>
            </section>
        </div>
        @endif

        

        
        @if (count($private_message_notifications) > 0 )
        <div class="md:flex-1 border-0">
            <section class="py-8 mt-2">
                    <div class="text-lg font-semibold text-gray-600 border-b border-gray-200 ">
                        Message Notifications ({{ $private_message_notifications->count() }})
                    </div>
                    <div>
                        <ul class="list-disc px-10">
                            @foreach ($private_message_notifications as $notification)
                                <li class="py-3 border-b border-gray-100">
                                    <a href="{{ route('staff.workflows.private_message.index', ['document'=>$notification->id, 'recipient'=>$notification->sender_id]) }}" title="{{ $notification->message }}" class="hover:underline"  >
                                    
                                        <div class="font-medium text-gray-700">
                                            {{$notification->message}}
                                        </div>
                                        <div class="text-xs">
                                            from {{ $notification->sender->surname}} @ 
                                            {{ $notification->created_at->format('l jS F, Y g:i a')}}
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                        <div class="py-2">
                                {{ $workflow_notifications->links() }}
                        </div>

                    </div>
            </section>
        </div>
        @endif



        <!-- recent workflows //-->
        <div class="md:flex-1 border-0">
                <div class="text-lg font-semibold text-gray-600 border-b border-gray-200 mt-10">
                    Recent Workflows
                </div>
                <div>
                    <ul class="list-disc  px-10">
                    @foreach ($recent_workflows as $workflow)
                            @if ($workflow->sender_id != Auth::user()->id)
                                <li class="py-3 border-b border-gray-100">
                                    <a title="{{$workflow->document->title}}" class="hover:underline" href="{{ route('staff.workflows.flow', ['document'=>$workflow->document->id]) }}" >
                                    
                                            <div class="font-medium text-gray-700">
                                            {{$workflow->document->title}}
                                            </div>
                                            <div class="text-xs">
                                                from {{ $workflow->sender->surname}} @ 
                                                {{ $workflow->created_at->format('l jS F, Y g:i a')}}
                                            </div>
                                    </a>
                                </li>
                            @endif
                    @endforeach
                    </ul>
                    <div class="py-2">
                        {{ $workflow_notifications->links() }}
                    </div>
                </div>

        </div>
        <!-- end of recent workflows //-->




        

    </div>


    
</div>

</x-staff-layout>