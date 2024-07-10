<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\College;
use App\Models\Department;

class Admin_DepartmentController extends Controller
{
    //
    public function index(){
        $departments = Department::orderBy('department_name', 'asc')->get();
        return view('admin.departments.index', compact('departments'));
    }

    public function create(){
        $colleges = College::orderBy('college_name', 'asc')->get();
        return view('admin.departments.create', compact('colleges'));
    }

    public function store(Request $request){
        $formFields = $request->validate([
            'college' => 'required',
            'department_name' => 'required | string',
            'department_code' => ['required', 'string']
        ]);

        $formFields['college_id'] = $formFields['college'];

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
                    'message' => 'An error occurred creating the Department '.$e->getMessage()
            ];
        }
        

        
        return redirect()->back()->with($data);
        
    }


    public function edit(Department $department){
        $colleges = College::orderBy('college_name', 'asc')->get();
        

        return view('admin.departments.edit', compact('colleges', 'department'));
    }

    public function update(Request $request, Department $department){
        $formFields = $request->validate([
            'college' => 'required',
            'department_name' => ['required', 'string'],
            'department_code' => 'required | string'
        ]);

        $update = $department->update($formFields);

        try{
            if ($update){
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'The department has been successfully updated'
                ];
            }else{
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred updating the department'
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

}
