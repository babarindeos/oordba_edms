<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Division;
use App\Models\Department;

class Admin_DivisionController extends Controller
{
    //
    public function index()
    {
        $divisions = Division::orderBy('id', 'desc')->paginate(5);
        return view('admin.divisions.index', compact('divisions'));
    }

    public function create()
    {
        $departments = Department::orderBy('department_name', 'desc')->get();
        return view('admin.divisions.create')->with('departments', $departments);
    }

    public function store(Request $request)
    {
        $formFields = $request->validate([
            'department' => ['required', 'string'],
            'name' => ['required', 'string', 'unique:divisions,name'],
            'code' => ['required', 'string', 'unique:divisions,code']
        ]);

        $formFields['department_id'] = $formFields['department'];

        try
        {
            $create = Division::create($formFields);

            if ($create)
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'Division has been successfully created'
                ];
            }
            else
            {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred creating the Division'
                ];
            }
            
        }
        catch(\Exception $e)
        {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'An error occurred'.$e->getMessage()
                ];
        }
        
        return redirect()->back()->with($data);
    }

    public function edit(Division $division)
    {
        $departments = Department::orderBy('department_name', 'asc')->get();

        return view('admin.divisions.edit', ['departments' => $departments, 'division' => $division]);
    }

    public function update(Request $request, Division $division)
    {
        $formFields = $request->validate([
            'department' => ['required', 'string'],
            'name' => ['required', 'string'],
            'code' => ['required', 'string'],
        ]);

        $formFields['department_id'] = $formFields['department'];

        try
        {
            $update = $division->update($formFields);

            if ($update)
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'Division has been successfully updated'
                ];
            }
            else
            {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred updating the Division'
                ];
            }
        }
        catch(\Exception $e)
        {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred '.$e->getMessage()
                ];
        }
        
        return redirect()->back()->with($data);

    }

    public function destroy(Division $division)
    {
        if ($division == null)
        {
            return redirect()->back();
        }

        return view('admin.divisions.destroy', compact('division'));
    }

    public function confirm_delete()
    {

    }


}
