<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\HeaderContent;

class HeaderContentController extends Controller
{
    public function index()
    {
        return view('admin.header_content');
    }

    public function create(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'type' => 'nullable',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            notify()->error('Please fill up the all.');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // Fetch the current count of entries and set the flag
        $currentCount = HeaderContent::count();

        // Create the content using the validated data
        $content = new HeaderContent();
        $content->title = $request->input('title');
        $content->description = $request->input('description');
        $content->type = $request->input('type');
        $content->flag = $currentCount + 1; // Increment the flag by 1

        // Attempt to save the content and check the result
        if ($content->save()) {
            notify()->success('Header Content created successfully!');
        } else {
            notify()->error('Header Content was not created.');
        }

        // Redirect back to the form
        return redirect()->route('admin.header_content');
    }

    public function list()
    {
        // Fetch all header content records
        $headerContents = HeaderContent::all();
        return view('admin.header_content_list', compact('headerContents'));
    }
    public function edit($id)
    {
        // Fetch the content by ID
        $content = HeaderContent::findOrFail($id);
        return view('admin.edit_header_content', compact('content'));
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'type' => 'required',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            notify()->error('Please fill up all fields.');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Fetch the content by ID
        $content = HeaderContent::findOrFail($id);
        $content->title = $request->input('title');
        $content->description = $request->input('description');
        $content->type = $request->input('type');

        // Attempt to save the updated content and check the result
        if ($content->save()) {
            notify()->success('Header Content updated successfully!');
        } else {
            notify()->error('Header Content was not updated.');
        }

        // Redirect back to the list
        return redirect()->route('admin.header_content_list');
    }

    public function toggleStatus($id)
    {
        $headerContents = HeaderContent::findOrFail($id);
       // dd($headerContents);
        // Toggle the status: if it is 1 (active), set it to 0 (inactive) and vice versa.
        $headerContents->status = $headerContents->status === 1 ? 0 : 1;
        $headerContents->save();

        return redirect()->route('admin.header_content_list')->with('success', 'Header Content status updated successfully!');
    }
}
