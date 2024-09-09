<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\College;
use App\Models\Department;
use App\Models\Ministry;
use App\Models\Directorate;

class Admin_DepartmentController extends Controller
{
    //
    public function index(){
        $departments = Department::orderBy('department_name', 'asc')->paginate(2);
        return view('admin.departments.index', compact('departments'));
    }

    public function create(){
        
        $directorates = Directorate::orderBy('name', 'asc')->get();
        return view('admin.departments.create', compact('directorates'));
    }

    public function store(Request $request){
        
        $formFields = $request->validate([
            'directorate' => 'required',
            'department_name' => 'required | string',
            'department_code' => ['required', 'string']
        ]);

        $formFields['directorate_id'] = $formFields['directorate'];

        

        try{
            $create = Department::create($formFields);

            if ($create){
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'The Department has been successfully created'
                ];
            }else{
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred creating the Department'
                ];
            }
    
        }catch(\Exception $e)
        {
            $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred creating the Department'.$e->getMessage()
            ];
        }
        

        
        return redirect()->back()->with($data);
        
    }


    public function edit(Department $department){
        //$colleges = College::orderBy('college_name', 'asc')->get();
        $directorates = Directorate::orderBy('name', 'asc')->get();
        

        return view('admin.departments.edit', compact('directorates', 'department'));
    }

    public function update(Request $request, Department $department){
        $formFields = $request->validate([
            'directorate' => 'required',
            'department_name' => ['required', 'string'],
            'department_code' => 'required | string'
        ]);

        $formFields['directorate_id'] = $formFields['directorate'];

        try{
            $update = $department->update($formFields);

            if ($update){
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'The Department has been successfully updated'
                ];
            }else{
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred updating the Department'
                ];
            }
        }catch(\Exception $e){
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred '.$e->getMessage()
                ];
        }

        return redirect()->back()->with($data);
        
    }


    public function destroy(Department $department)
    {
        
        return view('admin.departments.destroy', compact('department'));

    }

    public function confirm_delete(Request $request, Department $department)
    {

    }

}
