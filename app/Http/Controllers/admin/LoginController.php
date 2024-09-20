<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    //this method will show login page for admin
    public function index(){
        return view('admin.login');
    }
    // Show edit form for admin profile
    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        // dd($admin);
        return view('admin.profile_edit', ['admin' => $admin]);
    }

    // Update admin profile
    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,' . $id,
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.profile_edit', $id)->withInput()->withErrors($validator);
        }

        $admin = Admin::findOrFail($id);
        $admin->first_name = $request->first_name;
        $admin->last_name = $request->last_name;
        $admin->email = $request->email;
        $admin->updated_at = Carbon::now();

        $admin->save();

        return redirect()->route('admin.dashboard')->with('success', 'Profile updated successfully!');
    }


    // this method will authenticate admin
    public function authenticate(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if($validator -> passes()){
            if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])){
                return redirect()->route('admin.dashboard');

            }else{
                return redirect()->route('admin.login')->with('error','either email or password is incorrect');
            }

        }else{
            return redirect()->route('admin.login')->withInput()->withErrors($validator);
        }
    }
    //this method  will logout admin
    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
