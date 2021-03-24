<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        // return $user;
        return view('backend.profile.index', compact('user'));
    }
    public function update(Request $request)
    {
        $user = Auth::user();
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'password' => 'nullable|confirmed|string|min:6',
            'avatar' => 'nullable|image',
        ]);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => isset($request->password) ? Hash::make($request->password) : $user->password,
            'status' => $request->filled('status'),
        ]);
        if($request->hasFile('avatar')){
            $user->addMedia($request->avatar)->toMediaCollection('avatar');
        }
        notify()->success("User Updated","Success");    
        return back();
    }
    public function changePassword()
    {
        return view('backend.profile.password');
    }
    public function updatePassword(Request $request)
    {
        $user = Auth::user();
        $this->validate($request, [
            'current_password' => 'required|string|min:6',
            'password' => 'required|confirmed|string|min:6',
        ]);
        $hashedPassword = $user->password;
        if(Hash::check($request->current_password, $hashedPassword)){
            if(!Hash::check($request->password, $hashedPassword)){
                $user->update([
                    'password' => Hash::make($request->password),
                ]);
                Auth::logout();
                return redirect()->route('login')->with('message', 'Password Changed Successfully!');;
            } else {
                notify()->warning("New Password Can\'t be same as Old Password!","Error"); 
            }
        } else {
            notify()->error("Current Password Not Matched!","Error"); 
        }
            
        return back();
    }
}
