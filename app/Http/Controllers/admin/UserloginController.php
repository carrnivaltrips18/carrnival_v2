<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; // Make sure to import the User model
class UserloginController extends Controller
{
    /**
     * Display a listing of the resource.
     */


     public function index()
     {
         $users = User::all(); // Fetch all users from the database
         return view('admin.users_list')->with('users', $users); // Pass users to the view
     }

     public function status_active_deactive(Request $request)
    {
        $Ids = $request->id; // Get the user ID from the request
        $result = User::find($Ids); // Find the user by ID

        // Check if the user's current status is active
        if ($result->status == 1) {
            $update_arr = [
                'status' => 0 // Set status to inactive
            ];
            $response = User::where('id', $request->id)->update($update_arr); // Update the user's status
            return true; // Indicate success
        }

        // If the user's status is inactive
        if ($result->status == 0) {
            $update_arr = [
                'status' => 1 // Set status to active
            ];
            $response = User::where('id', $request->id)->update($update_arr); // Update the user's status
            return true; // Indicate success
        }
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
