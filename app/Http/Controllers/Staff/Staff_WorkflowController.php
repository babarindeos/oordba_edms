<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\Staff;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use App\Models\FlowContributor;

class Staff_WorkflowController extends Controller
{
    //
    public function flow(Document $document)
    {
        
        return view('staff.workflows.flow', compact('document'));
    }

    public function add_contributor(Document $document)
    {
        $staff = null;
        $workflow_contributors = FlowContributor::where('doc_id', $document->id)->get();
        
        return view('staff.workflows.add_contributor', compact('document', 'staff', 'workflow_contributors'));
    }

    public function post_add_contributor(Request $request, Document $document)
    {
        $formFields = $request->validate([
            'user_id' => 'required'
        ]);

        $data = [
            'doc_id' => $document->id,
            'user_id' => $formFields['user_id'],
            'added_by' => auth()->user()->id
        ];

        $contributor_already_added = FlowContributor::where('doc_id', $document->id)
                                                    ->where('user_id', $formFields['user_id'])->exists();
        
        if ($contributor_already_added)
        {
            $data = [
                'error' => true,
                'status' => 'fail',
                'message' => "The Contributor has aready been added to this Workflow"
            ];

            return redirect()->back()->with($data);
        }

               
        

        try
        {
            $createContributor = FlowContributor::create($data);

            if ($createContributor)
            {
                return redirect()->route('staff.workflows.flow', ['document'=>$document]);
            }
            else
            {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred adding the Contributor'
                ];
            }
        }
        catch(\Exception $e)
        {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred adding the Contributor: '.$e->getMessage()
                ];
        }

        return redirect()->back()->with($data);
        
    }

    public function search_staff(Request $request, Document $document)
    {
         $formFields = $request->validate([
            'staffno' => ['required', 'string']
         ]);

         

         $staff = Staff::where('fileno', $request->input('staffno'))->first();

         //dd(auth()->user()->id);
         //dd(Auth::user()->id);
         if ($staff->user_id == auth()->user()->id)
         {
             $data = [
                'error' => true,
                'status' => 'fail',
                'message' => "You can't add yourself as a contributor"
             ];

             $staff = null;
             return redirect()->back()->with($data);
         }

         
         
                 
         return redirect()->back()->with(['error'=>false, 'status'=>'success', 'staff' => $staff]);
         //return view('staff.workflows.add_contributor', compact('document','staff'))->with(['error'=>false, 'status'=>'success']);
         
    }
}
