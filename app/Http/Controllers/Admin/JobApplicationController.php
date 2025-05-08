<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdmitCard;
use App\Models\JobApplication;
use App\Models\Position;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class JobApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {
        $position = Position::where('id', $id)->first();

        if (\request()->ajax()) {

            $jobApplications = JobApplication::query()->where('position_id', $id);
            return   DataTables::of($jobApplications)
                ->addColumn('status', function ($jobApplication) {

//                if(Auth::guard('admin')->user()->can('Status Admin')) {
                    if ($jobApplication->status == 1) {
                        return ' <a class="status" id="adminStatus" href="javascript:void(0)"
                                               data-id="'.$jobApplication->id.'" data-status="'.$jobApplication->status.'"> <i
                                                        class="fa-solid fa-toggle-on fa-2x"></i>
                                            </a>';
                    } else {

                        return '<a class="status" id="adminStatus" href="javascript:void(0)"
                                               data-id="'.$jobApplication->id.'" data-status="'.$jobApplication->status.'"> <i
                                                        class="fa-solid fa-toggle-off fa-2x" style="color: grey"></i>
                                            </a>';

                    }
//                }

                })
                ->addColumn('action', function ($jobApplication) {

                    $editRoute      = route('admin.jobapplication.edit', $jobApplication->id);
                    $admitPrevRoute  = route('admin.admitcard.preview', $jobApplication->id);

                    $admitPrevAction    = '<a class="editButton btn btn-sm btn-success" href="'.$admitPrevRoute.'">
                                   <i class="fas fa-eye"></i> View Admit
                                   </a>';

                    $editAction     = '<a class="editButton btn btn-sm btn-primary" href="'.$editRoute.'">
                                   <i class="fas fa-edit"></i></a>';

                    $deleteAction   = '<a class="btn btn-sm btn-danger" href="javascript:void(0)"
                                   data-id="'.$jobApplication->id.'" id="deleteAdminBtn""> 
                                   <i class="fas fa-trash"></i></a>';

//              if(Auth::guard('admin')->user()->can('Edit Admin')) {
//
//                  $editAction= '<a class="editButton btn btn-sm btn-primary" href="javascript:void(0)"
//                                    data-id="'.$admin->id.'" data-bs-toggle="modal" data-bs-target="#editAdminModal">
//                                    <i class="fas fa-edit"></i></a>';
//
//              }
//
//              if(Auth::guard('admin')->user()->can('Delete Admin')) {
//
//                  $deleteAction= '<a class="btn btn-sm btn-danger" href="javascript:void(0)"
//                                    data-id="'.$admin->id.'" id="deleteAdminBtn""> 
//                                    <i class="fas fa-trash"></i></a>';
//
//              }

                    return '<div class="d-flex gap-3"> '.$admitPrevAction.$editAction.$deleteAction.'</div>';

                })
                ->rawColumns(['action', 'status'])
                ->make(true);

        }
        
        return view('backend.pages.job_application.index', compact('position'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {
        $position = Position::find($id);
        
        return view('backend.pages.job_application.create',compact('position'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        dd($request->all());
        $jobApplication = new JobApplication();
        $jobApplication->job_post_id = $request->job_post_id;
        $jobApplication->position_id = $request->position_id;
        $jobApplication->candidate_name = $request->candidate_name;
        $jobApplication->candidate_email = $request->candidate_email;
        $jobApplication->candidate_phone = $request->candidate_phone;
        $jobApplication->fathers_name = $request->fathers_name;
        $jobApplication->mothers_name = $request->mothers_name;
        $jobApplication->temporary_password = uniqid();
        $jobApplication->status = $request->status;
        $jobApplication->payment_status = $request->payment_status;
        $jobApplication->applicant_status = $request->applicant_status;
        
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $filename = time().uniqid().$file->getClientOriginalExtension();
            $file->move(public_path('backend/upload/job_application/'), $filename);
            $jobApplication->img ='backend/upload/job_application/'. $filename;
        }
        
        if ($request->hasFile('signature'))
        {
            $file = $request->file('signature');
            $filename = time().uniqid().$file->getClientOriginalExtension();
            $file->move(public_path('backend/upload/job_application/'), $filename);
            $jobApplication->signature ='backend/upload/job_application/'. $filename;
        }
        
        $application = $jobApplication->save();
        
        //Unique Roll number
        $year = date('Y');
        $maxId = JobApplication::whereYear('created_at', $year)->max('id');
        $last = $maxId ? $maxId + 1 : 1;

        $roll = $year . str_pad($last, 4, '0', STR_PAD_LEFT);
        
        $admit = new AdmitCard();
        $admit->job_post_id = $request->job_post_id;
        $admit->job_application_id = $jobApplication->id;
        $admit->position_id = $request->position_id;
        $admit->role_number = $roll;
        $admit->candidateID = uniqid();
        $admit->systemID = time().uniqid();
        $admit->save();
        
        
        
        return redirect()->route('admin.jobapplication.index',$request->position_id)->with('success', 'Job Application Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $jobApplication = JobApplication::find($id);
        
        return view('backend.pages.job_application.edit', compact('jobApplication'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
//        dd($request->all());
        $jobApplication = JobApplication::find($id);
        $jobApplication->candidate_name = $request->candidate_name;
        $jobApplication->candidate_email = $request->candidate_email;
        $jobApplication->candidate_phone = $request->candidate_phone;
        $jobApplication->fathers_name = $request->fathers_name;
        $jobApplication->mothers_name = $request->mothers_name;
        $jobApplication->temporary_password = uniqid();
        $jobApplication->status = $request->status;
        $jobApplication->payment_status = $request->payment_status;
        $jobApplication->applicant_status = $request->applicant_status;

        if ($request->hasFile('img')) {
            
            if ($jobApplication->img && file_exists(public_path($jobApplication->img))) {
                unlink(public_path($jobApplication->img));
            }
            
            $file = $request->file('img');
            $filename = time().uniqid().$file->getClientOriginalExtension();
            $file->move(public_path('backend/upload/job_application/'), $filename);
            $jobApplication->img ='backend/upload/job_application/'. $filename;
        }

        if ($request->hasFile('signature'))
        {
            if ($jobApplication->signature && file_exists(public_path($jobApplication->signature))) {
                unlink(public_path($jobApplication->signature));
            }
            
            $file = $request->file('signature');
            $filename = time().uniqid().$file->getClientOriginalExtension();
            $file->move(public_path('backend/upload/job_application/'), $filename);
            $jobApplication->signature ='backend/upload/job_application/'. $filename;
        }

        $jobApplication->save();

        return redirect()->route('admin.jobapplication.index',$jobApplication->position_id)->with('success', 'Job Application Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jobApplication = JobApplication::find($id);
        $jobApplication->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Position Deleted successfully'
        ], 200);

    }

    public function changeJobApplicationStatus(Request $request)
    {
        $id = $request->id;
        $status = $request->status;

        if ($status == 1) {
            $stat = 0;
        } else {
            $stat = 1;
        }

        $page = Position::findOrFail($id);
        $page->status = $stat;
        $page->save();

        return response()->json(['message' => 'success', 'status' => $stat, 'id' => $id]);
    }
}
