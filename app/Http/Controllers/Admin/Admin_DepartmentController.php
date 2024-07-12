<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\College;
use App\Models\Department;
use App\Models\Ministry;

class Admin_DepartmentController extends Controller
{
    //
    public function index(){
        $departments = Department::orderBy('department_name', 'asc')->paginate(2);
        return view('admin.departments.index', compact('departments'));
    }

    public function create(){
        
        $ministries = Ministry::orderBy('name', 'asc')->get();
        return view('admin.departments.create', compact('ministries'));
    }

    public function store(Request $request){
        
        $formFields = $request->validate([
            'ministry' => 'required',
            'department_name' => 'required | string',
            'department_code' => ['required', 'string']
        ]);

        $formFields['ministry_id'] = $formFields['ministry'];

        try{
            $create = Department::create($formFields);

            if ($create){
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'The Department or Agency has been successfully created'
                ];
            }else{
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred creating the Department or Agency'
                ];
            }
    
        }catch(\Exception $e)
        {
            $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred creating the Department or Agency'.$e->getMessage()
            ];
        }
        

        
        return redirect()->back()->with($data);
        
    }


    public function edit(Department $department){
        //$colleges = College::orderBy('college_name', 'asc')->get();
        $ministries = Ministry::orderBy('name', 'asc')->get();
        

        return view('admin.departments.edit', compact('ministries', 'department'));
    }

    public function update(Request $request, Department $department){
        $formFields = $request->validate([
            'ministry' => 'required',
            'department_name' => ['required', 'string'],
            'department_code' => 'required | string'
        ]);

        $formFields['ministry_id'] = $formFields['ministry'];

        try{
            $update = $department->update($formFields);

            if ($update){
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'The Department or Agency has been successfully updated'
                ];
            }else{
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred updating the Department or Agency'
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
