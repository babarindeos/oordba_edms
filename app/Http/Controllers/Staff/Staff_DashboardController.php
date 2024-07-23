<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Workflow;
use App\Models\PrivateMessage;
use Illuminate\Support\Facades\Auth;

class Staff_DashboardController extends Controller
{
    //
    public function index()
    {
        // get notification
        $workflow_notifications = Workflow::where('recipient_id', Auth::user()->id)
                                            ->where('read', false)
                                            ->orderBy('id', 'desc')->paginate(5);

        $private_message_notifications = PrivateMessage::where('recipient_id', Auth::user()->id)
                                                       ->where('read', false)
                                                       ->orderBy('id', 'desc')->paginate(5);

        $recent_workflows = Workflow::latest()->take(5)->get();        

        return view('staff.dashboard', compact('workflow_notifications', 'recent_workflows', 'private_message_notifications'));

    }
}
