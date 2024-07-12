<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Classes\Document;

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




            dd($new_filename);


            
        }
    }
}
