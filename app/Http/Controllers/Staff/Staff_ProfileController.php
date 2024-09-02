<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use App\Models\Staff;

class Staff_ProfileController extends Controller
{
    //

    public function create()
    {
        $isProfile = Profile::where('user_id', Auth::user()->id)->first();

        return view('staff.profile.create')->with('profile', $isProfile);
    }

    public function store(Request $request)
    {
        $formFields = $request->validate([            
            'designation' => 'required',
            'phone' => 'required'
        ]);

        $avatar = '';
        $new_filename = '';
        $user_id = '';
        $bio = '';

        $user_id = auth()->user()->id;

        if ($request->hasFile('avatar'))
        {
           
            $filename = $user_id;

            $avatar_file = $request->file('avatar');
            $new_filename = $filename.'.'.$avatar_file->getClientOriginalExtension();

            $avatar_file->storeAs('avatars', $new_filename);
        }

        if ($new_filename!='')
        {
            $new_filename = 'avatars/'.$new_filename;
        }

        try
        {

            $isProfile = Profile::where('user_id', auth()->user()->id)->first();
            

            if ($isProfile && $new_filename=='')
            {
                $new_filename = $isProfile->avatar;               
            }

            $store_data = [
                'user_id' => $user_id,
                'designation' => $formFields['designation'],
                'phone' => $formFields['phone'],
                'avatar' => $new_filename,
                'bio' => $bio
            ];
           
            

            if ($isProfile==null)
            {
                $create = Profile::create($store_data);

                if ($create)
                {
                    $data = [
                        'error' => true,
                        'status' => 'success',
                        'message' => 'Profile has been successfully created'
                    ];
                }
                else
                {
                    $data = [
                        'error' => true,
                        'status' => 'fail',
                        'message' => 'An error occurred creating your Profile'
                    ];
                }
            }
            else
            {
                
                $update = $isProfile->update($store_data);

                if ($update)
                {
                    $data = [
                        'error'=> true,
                        'status' => 'success',
                        'message' => 'Profile has been successfully updated'
                    ];
                }
                else
                {
                    $data = [
                        'error' => true,
                        'status' => 'fail',
                        'message' => 'An error occurred updating your Profile'
                    ];
                }
            }
        }
        catch(\Exception $e)
        {
            $data = [
                'error' => true,
                'status' => 'fail',
                'message' => 'An error occurred '.$e->getMessage()
            ];
            dd($e->getMessage());
        }

        $isProfile = Profile::where('user_id', Auth::user()->id)->first();

        return redirect()->back()->with(['profile' => $isProfile]);
    }

    public function upload_avatar(Request $request)
    {
        dd($request->hasFile('avatar'));
    }

    public function myprofile()
    {
        return view('staff.profile.myprofile');
    }

    public function edit()
    {
        return view('staff.profile.edit');
    }

    public function update(Request $request)
    {
        $formFields = $request->validate([
            'designation' => 'required',
            'phone' => 'required'
        ]);

        $profile = Profile::where('user_id', auth()->user()->id)->first();
        
        $profile->designation = $formFields['designation'];
        $profile->phone = $formFields['phone'];
        $profile->update();

        return redirect()->route('staff.profile.myprofile');
    }

    public function update_avatar(Request $request)
    {
        $formFields = $request->validate([
            'photo' => 'required|file|mimes:png,jpg,jpeg|max:500'
        ]);

        try
        {
            $update = '';
            if ($request->hasFile('photo'))
            {
                $filename = auth()->user()->id;
                $avatar_file = $request->file('photo');
                $new_filename = $filename.'.'.$avatar_file->getClientOriginalExtension();
                
                $update = $avatar_file->storeAs('avatars', $new_filename);

                if ($update != '')
                {
                    $profile = Profile::where('user_id', auth()->user()->id)->first();
                    $profile->avatar = $update;
                    $profile->save();
                }

                
            }
        }
        catch(\Exception $e)
        {

        }
        
        return redirect()->back();
    }

    public function user_profile($fileno)
    {
        $userprofile = Staff::where('fileno', $fileno)->first();
        
        return view('staff.profile.user_profile', compact('userprofile'));
    }
}
