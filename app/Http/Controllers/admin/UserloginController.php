<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory; // Add this line
use Illuminate\Support\Facades\Hash;

use PhpOffice\PhpSpreadsheet\Writer\Csv;
use Symfony\Component\HttpFoundation\StreamedResponse;
use App\Models\User; // Make sure to import the User model

class UserloginController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function exportCsv()
    {
        // Fetch users with their hobbies
        $users = User::get();

        // Create a new spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set headers
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Name');
        $sheet->setCellValue('C1', 'Email');
        // Password is not included for security reasons
        $sheet->setCellValue('D1', 'Role');
        $sheet->setCellValue('E1', 'Created At');
        $sheet->setCellValue('F1', 'Updated At');
        $sheet->setCellValue('G1', 'Status');

        // Add data
        $row = 2;
        foreach ($users as $user) {
            $hobbies = $user->users; // Hobbies can be included if needed

            $sheet->setCellValue('A' . $row, $user->id);
            $sheet->setCellValue('B' . $row, $user->name);
            $sheet->setCellValue('C' . $row, $user->email);
            $sheet->setCellValue('D' . $row, $user->role);
            $sheet->setCellValue('E' . $row, $user->created_at); // Corrected
            $sheet->setCellValue('F' . $row, $user->updated_at); // Corrected
            $sheet->setCellValue('G' . $row, $user->status);
            $row++;
        }

        // Export as CSV
        $writer = new Csv($spreadsheet);
        $fileName = 'users.csv';

        return new StreamedResponse(function () use ($writer) {
            $writer->save('php://output');
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment;filename="' . $fileName . '"',
        ]);
    }


    public function uploadCsv(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt',
        ]);

        $file = $request->file('file');
        $spreadsheet = IOFactory::load($file->getPathName());
        $sheet = $spreadsheet->getActiveSheet();
        $data = $sheet->toArray();

        // Skip the header row (first row)
        foreach ($data as $key => $row) {
            if ($key === 0) {
                continue;
            }

            $user = User::create([
                'name' => $row[1],
                'email' => $row[2],
                'password' => Hash::make('password'), // Set a default password, you can customize it
                'role' => $row[3],
                'created_at' => $row[4],
                'updated_at' => $row[5],
                'status' => $row[6],
            ]);
        }

        return redirect()->back()->with('success', 'CSV file imported successfully.');
    }



     public function index(Request $request)
     {
         // Trim the search input to avoid unnecessary spaces
         $search = $request->input('search') ? trim($request->input('search')) : null;
     
         $users = User::query()
             ->when($search, function($query) use ($search) {
                 return $query->where('name', 'like', '%' . $search . '%')
                              ->orWhere('email', 'like', '%' . $search . '%');
             })
             ->paginate(3); // Paginate results
     
         return view('admin.users_list', compact('users'));
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
