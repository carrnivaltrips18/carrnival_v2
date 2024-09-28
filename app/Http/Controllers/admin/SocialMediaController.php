<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\SocialMedia;
class SocialMediaController extends Controller
{
    public function index()
    {
        return view('admin.socialmedia');
    }
    public function create(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'link' => 'required|url',
        ]);
        if ($validator->fails()) {
            notify()->error('The link field is required...');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $socialmedia = new SocialMedia();
        $socialmedia-> name = $request->input('name');
        $socialmedia-> link = $request->input('link');
        $socialmedia-> svg_icon =$request -> input('svg_icon');
        if ($request->hasFile('logo_path')) {
            $logo_path = $request->file('logo_path');
            $ext = $logo_path->getClientOriginalExtension();
            $logoimage = "logo/" . time() . '.' . $ext;
            // dd($image, $ext, $logoimage, $banners);
            $logo_path->move(public_path('logo'), $logoimage);
            $socialmedia->logo_path = $logoimage;
        }
        $res = $socialmedia->save();{
        if($res){
            notify()->success(' created successfully!');
        }else{
            notify()->error(' is not  created..!');
        }
        return redirect()->route('admin.socialmedia_form');
    }

    }
    public function list()
    {
        $socialmedias = SocialMedia::all();
        return view('admin.socialmedia_list', compact('socialmedias'));
    }

    public function toggleStatus($id)
    {
        $socialmedia = SocialMedia::findOrFail($id);
       // dd($headerContents);
        // Toggle the status: if it is 1 (active), set it to 0 (inactive) and vice versa.
        $socialmedia->status = $socialmedia->status === 1 ? 0 : 1;
        $res = $socialmedia->save();
        if($res){
            notify()->success(' created successfully!');
        }else{
            notify()->error(' is not  created..!');
        }

        return redirect()->route('admin.socialmedia_list');
    }
    public function delete($id)
    {
        $socialmedia = SocialMedia::findOrFail($id);
        if ($socialmedia->logo_path) {
            // Delete old image
            File::delete(public_path('logo/' . $socialmedia->logo_path));
        }
        $res = $socialmedia->delete();
        if($res){
            notify()->success(' deleted successfully!');
        }else{
            notify()->error(' is not deleted');
        }

        return redirect()->route('admin.socialmedia_list');
    }
    public function edit($id)
{
    $socialMedia = SocialMedia::findOrFail($id); // Fetch the record by ID
    return view('admin.socialmedia_edit', compact('socialMedia'));
}
public function update(Request $request, $id)
{
    $validator = Validator::make($request->all(), [
        'link' => 'required|url',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $socialMedia = SocialMedia::findOrFail($id);
    $socialMedia->name = $request->input('name');
    $socialMedia->link = $request->input('link');
    $socialMedia->svg_icon = $request->input('svg_icon');

    // Handle logo upload
    if ($request->hasFile('logo')) {
        $logo = $request->file('logo');
        $ext = $logo->getClientOriginalExtension();
        $logoImage = "logo/" . time() . '.' . $ext;
        $logo->move(public_path('logo'), $logoImage);
        $socialMedia->logo = $logoImage; // Save the new logo path
    }

    $res = $socialMedia->save();
    if($res){
        notify()->success(' deleted successfully!');
    }else{
        notify()->error(' is not deleted');
    }

    return redirect()->route('admin.socialmedia_list');
}



}
