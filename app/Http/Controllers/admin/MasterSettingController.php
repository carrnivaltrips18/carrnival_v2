<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterRequest; // Make sure to create this request class for validation
use App\Models\MasterSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MasterSettingController extends Controller
{
    /**
     * Display the master settings.
     */
    public function index()
    {
        $details = MasterSetting::first();
        return view('admin.master_setting', [
            'details' => $details
        ]);
    }

    /**
     * Store or update the master settings.
     */
    public function store(Request $request)
    {
        $master_setting = $request->id ? MasterSetting::find($request->id) : new MasterSetting();

        // Assign values from the request
        $master_setting->company_title = $request->company_title;
        $master_setting->phone = $request->phone;
        $master_setting->email = $request->email;
        $master_setting->address = $request->address;
        $master_setting->description = $request->description;
        $master_setting->facebook = $request->facebook;
        // $master_setting->twitter = $request->twitter;
        $master_setting->instagram = $request->instagram;
        $master_setting->youtube = $request->youtube;
        $master_setting->linkdn = $request->linkdn;
        $master_setting->compnay_link = $request->compnay_link;

        // Handle logo file upload
        if ($request->hasFile('logo')) {
            if ($request->id && $master_setting->logo) {
                File::delete(public_path('logo/' . $master_setting->logo));
            }
            $logo = $request->file('logo');
            $logofilename = "logo" . time() . '.' . $logo->getClientOriginalExtension();
            $logo->move(public_path('logo'), $logofilename);
            $master_setting->logo = $logofilename;
        }

        // Handle favicon file upload
        if ($request->hasFile('fav_icon')) {
            if ($request->id && $master_setting->fav_icon) {
                File::delete(public_path('fav_icon/' . $master_setting->fav_icon));
            }
            $fav_icon = $request->file('fav_icon');
            $fav_iconfilename = "fav_icon" . time() . '.' . $fav_icon->getClientOriginalExtension();
            $fav_icon->move(public_path('fav_icon'), $fav_iconfilename);
            $master_setting->fav_icon = $fav_iconfilename;
        }

        // Save the master settings
        $master_setting->save();
        return redirect()->route('admin.master_setting')->with('success', 'Settings saved successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $details = MasterSetting::findOrFail($id);
        return view('admin.master_setting', compact('details'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $setting = MasterSetting::findOrFail($id);
        if ($setting->logo) {
            File::delete(public_path('logo/' . $setting->logo));
        }
        if ($setting->fav_icon) {
            File::delete(public_path('fav_icon/' . $setting->fav_icon));
        }
        $setting->delete();

        return redirect()->route('admin.master_setting')->with('success', 'Settings deleted successfully!');
    }
}
