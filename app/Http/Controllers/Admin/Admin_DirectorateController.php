<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Directorate;
use App\Models\Department;
use Illuminate\Validation\Rule;

class Admin_DirectorateController extends Controller
{

    //
    public function index()
    {
        $directorates = Directorate::orderBy('name','asc')->orderBy('code','asc')->paginate(2);
        return view('admin.directorates.index', compact('directorates'));
    }

    public function create()
    {
        return view('admin.directorates.create');
    }


    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => ['required', 'string'],
            'code' => ['required', 'string']
        ]);

        $directorate_exist = Directorate::where('name', $request->input('name'))
                                    ->Orwhere('code', $request->input('code'))
                                    ->exists();
        
        if ($directorate_exist == false)
        {
            $create = Directorate::create($formFields);

            if ($create)
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'Directorate has been successfully created'
                ];
            }
            else
            {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred creating the Directorate. '
                ];
            }
        }
        else
        {
            $data = [
                'error' => true,
                'status' => 'fail',
                'message' => 'A Directorate with that name or code already exist'
            ];
        }

        return redirect()->back()->with($data);
    }

    public function show(Ministry $ministry)
    {
        $departments = Department::where('ministry_id', $ministry->id)->paginate(2);
        
        return view('admin.ministries.show', compact('ministry','departments'));
    }


    public function edit(Directorate $directorate)
    {
        return view('admin.directorates.edit', compact('directorate'));
    }

    public function update(Request $request, Directorate $directorate)
    {
        $formFields = $request->validate([
            'name' => 'required | string',
            'code' => 'required | string'
        ]);

        try
        {
            $update = $directorate->update($formFields);

            if ($update)
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'The Directorate has been successfully updated'
                ];
            }
            else
            {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred updating the Directorate'
                ];
            }
        }
        catch(\Exception $e)
        {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred updating the record: '.$e->getMessage()
                ];
        }

        return redirect()->back()->with($data);
        
    }

    public function destroy(Directorate $directorate)
    {
        return view('admin.directorates.destroy', compact('directorate'));

    }

    public function confirm_delete(Request $request, Ministry $ministry)
    {

    }




}
