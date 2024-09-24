<?php


namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

use App\Models\Notification;

class LoginController extends Controller
{
    //this method will show login page for admin
    public function index()
    {
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
            'current_password' => 'required_with:new_password|string', // Validate if current password is provided
            'new_password' => 'nullable|string|min:8|confirmed', // New password is optional but should be confirmed
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.profile_edit', $id)->withInput()->withErrors($validator);
        }

        $admin = Admin::findOrFail($id);
        $admin->first_name = $request->first_name;
        $admin->last_name = $request->last_name;
        $admin->email = $request->email;

        // Handle password update
        if ($request->new_password) {
            // Check if the current password is correct
            if (!Hash::check($request->current_password, $admin->password)) {
                throw ValidationException::withMessages([
                    'current_password' => ['The provided password does not match our records.'],
                ]);
            }
            // Update the password
            $admin->password = Hash::make($request->new_password);
        }

        $admin->updated_at = Carbon::now();

        $admin->save();
        Notify()->success('Profile updated successfully!');
        return redirect()->route('admin.dashboard');
    }


    // this method will authenticate admin
    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if ($validator->passes()) {

            if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
                $admin_details = Auth::guard('admin')->user();
                $notify_arr = [
                    'sender_id' => $admin_details->id,
                    'receiver_id' => 201,
                    'header' => 'hedaer text',
                    'description' => 'Admin Login Successfully',
                    'read_flag' => 0,
                    'created_at' =>   Carbon::now()->format('Y-m-d H:i:s'),
                ];
                Notification::create($notify_arr);
                $currentDateTime = now();
                notify()->success($admin_details->first_name . ' ' . "Login Successful!" . implode(',', [
                    'name' => $admin_details->first_name,
                    'email' => $admin_details->email,
                    'login_time' => $currentDateTime
                ]));
                return redirect()->route('admin.dashboard');
            } else {
                // dd('login here');
                return redirect()->route('admin.login')->with('error', 'either email or password is incorrect');
            }
        } else {
            return redirect()->route('admin.login')->withInput()->withErrors($validator);
        }
    }
    //this method  will logout admin
    public function logout()
    {

        $admins = Auth::guard('admin')->user();
        Auth::guard('admin')->logout();
        $notify_arr = [
            'sender_id' => $admins->id,
            'receiver_id' => 002,
            'header' => 'hedaer text',
            'description' => 'Admin Logout Successfully',
            'read_flag' => 0,
            'created_at' =>   Carbon::now()->format('Y-m-d H:i:s'),
        ];
        Notification::create($notify_arr);
        $currentDateTime = now();
        notify()->success($admins->first_name . '   ' . " Logout Successful!   " . implode(',', [
            'name' => $admins->last_name,
            'email' => $admins->email,
            'logout_time' => $currentDateTime
        ]));
        return redirect()->route('admin.login');
    }
    public function list(){
        $notifications = Notification::all();
        $notifications = Notification::paginate(10);
        return view('admin.notification_list')->with('notifications', $notifications);

    }

}


