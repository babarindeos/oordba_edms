<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\College;
use App\Models\Department;
use App\Models\Staff;


class Admin_StaffController extends Controller
{
    //
    public function index(){
       
        $staffs = Staff::orderBy('surname', 'asc')
                        ->orderBy('firstname', 'asc')
                        ->orderBy('middlename', 'asc')
                        ->get();
        return view('admin.staff.index', compact('staffs'));

    }

    public function create(){

        $colleges = College::orderBy('college_name', 'asc')->get();
        $departments = Department::orderBy('department_name', 'asc')->get();
        return view('admin.staff.create')->with(['colleges'=>$colleges, 'departments'=>$departments]);

    }

    public function store(Request $request){
        $formFields = $request->validate([
            'college' => 'required',
            'department' => ['required'],
            'staff_no' => 'required',
            'title' => 'required',
            'surname' => 'required | string',
            'firstname' => ['required', 'string'],
            'middlename' => ['required', 'string']
        ]);

        $formFields['surname'] = strtoupper($formFields['surname']);
        $formFields['firstname'] = ucfirst($formFields['firstname']);
        $formFields['middlename'] = ucfirst($formFields['middlename']);
        $formFields['college_id'] = $request->input('college');
        $formFields['department_id'] = $request->input('department');

        try{
            $create = Staff::create($formFields);

            if ($create){
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'The Staff has been successfully created'
                ];
            }else{
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred creating the Staff'
                ];
            }
        }catch(\Exception $e){
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred creating the Staff '.$e->getMessage()
                ];
        }

        return redirect()->back()->with($data);

    }


    public function edit(Request $request, Staff $staff){
        $departments = Department::orderBy('department_name', 'asc')->get();
        $colleges = College::orderBy('college_name', 'asc')->get();

        return view('admin.staff.edit', compact('staff', 'colleges', 'departments'));
    }

    
    public function update(Request $request, Staff $staff){
        $formFields = $request->validate([
            'college' => ['required'],
            'department' => ['required'],
            'title' => ['required', 'string'],
            'staff_no' => 'required | string',
            'surname' => 'required | string',
            'firstname' => 'required | string',
            'middlename' => 'required | string',
        ]);

        $formFields['college_id'] = $request->input('college');
        $formFields['department_id'] = $request->input('department');

        try{
            $update = $staff->update($formFields);

            if ($update){
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'Staff Information has been successfully updated'
                ];
            }else{
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred updating the staff information'
                ];
            }

        }catch(\Exception $e){
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred updating the staff information: '.$e->getMessage()
                ];
        }
       
        return redirect()->back()->with($data);
    }
}
