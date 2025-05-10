<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function index()
    {
        return view('backend.pages.job_application.import');
    }
    
    public function import(Request $request)
    {
        Excel::import(new UsersImport, $request->file('import_file') );

        return redirect()->back()->with('success', 'All good!');
    }
    
}
