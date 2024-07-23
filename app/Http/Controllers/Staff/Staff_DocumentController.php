<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Classes\Document;
use Illuminate\Support\Str;
use App\Models\Document as DocumentModel;
use App\Models\Workflow;
use App\Models\FlowContributor;


class Staff_DocumentController extends Controller
{
    //

    public function index()
    {
        return view('staff.documents.index');
    }

    public function create()
    {
        return view('staff.documents.create');
    }

    
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'document_title' => 'required|string',
            'document' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png',
            'comment' => 'string|max:140'
        ]);


        $document = '';
        $new_filename = '';
        $document_size = '';
        $document_type = '';

        if ($request->hasFile('document'))
        {
            $currentDateTime = Carbon::now()->format('Ymd_His');
            //$user_fileno = auth()->user()->fileno;   //alternate
            $user_fileno = Auth::user()->fileno;
            $user_fileno = strtolower($user_fileno);

            $user_id = auth()->user()->id;
            $user_id = "user".$user_id;

            $filename = $user_id.'_'.$user_fileno.'_'.$currentDateTime.'.';
            
            $document_file = $request->file('document');

            $document_size = Document::getDocumentSize($document_file);
            $document_type = Document::getDocumentType($document_file);

            $new_filename = $filename.$document_file->getClientOriginalExtension();

            $document_file->storeAs('documents', $new_filename);
            
        }


        $uuid = Str::uuid();

            $store_data = [
                'uuid' => $uuid,
                'title' => $formFields['document_title'],
                'document' => 'documents/'.$new_filename,
                'comment' => $formFields['comment'],
                'uploader' => auth()->user()->id,
                'filesize' => $document_size,
                'filetype' => $document_type
            ];

            try
            {
                $create = DocumentModel::create($store_data);

                if ($create)
                {
                    $data = [
                        'error' => true,
                        'status' => 'success',
                        'message' => 'Document has been successfully submitted'
                    ];
                }
                else
                {
                    $data = [
                        'error' => true,
                        'status' => 'fail',
                        'message' => 'An error occurred submitting the document'
                    ];
                }
            }
            catch(\Exception $e)
            {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred submitting the document: '.$e->getMessage()
                ];
            }



            return redirect()->back()->with($data);




    }

    public function show($document)
    {
        $document = DocumentModel::where('uploader', auth()->user()->id)
                                    ->where('id', $document)->first();
        
        $workflowCount = Workflow::where('doc_id', $document->id)->count();  
        
        $workflow_contributors = FlowContributor::where('doc_id', $document->id)->get();
        
        if ($document == null)
        {
            return redirect()->route('staff.documents.mydocuments');
        }
        
        return view('staff.documents.show', compact('document', 'workflowCount', 'workflow_contributors'));
    }

    public function mydocuments()
    {
        $my_user_id = auth()->user()->id;
        $mydocuments = DocumentModel::where('uploader', $my_user_id)->orderBy('id', 'desc')->paginate(2);
        return view('staff.documents.my_documents')->with('documents', $mydocuments);
    }







}
