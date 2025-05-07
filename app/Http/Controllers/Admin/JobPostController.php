<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobPost;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class JobPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.pages.job_post.index');
    }

    public function getData()
    {
        $jobPosts = JobPost::query();
        
        return   DataTables::of($jobPosts)
            ->addColumn('status', function ($jobPost) {

//                if(Auth::guard('admin')->user()->can('Status Admin')) {
                if ($jobPost->status == 1) {
                    return ' <a class="status" id="adminStatus" href="javascript:void(0)"
                                               data-id="'.$jobPost->id.'" data-status="'.$jobPost->status.'"> <i
                                                        class="fa-solid fa-toggle-on fa-2x"></i>
                                            </a>';
                } else {

                    return '<a class="status" id="adminStatus" href="javascript:void(0)"
                                               data-id="'.$jobPost->id.'" data-status="'.$jobPost->status.'"> <i
                                                        class="fa-solid fa-toggle-off fa-2x" style="color: grey"></i>
                                            </a>';

                }
//                }

            })
            ->addColumn('action', function ($jobPost) {
                
                $editRoute = route('admin.jobpost.edit', $jobPost->id);
                $positionRoute = route('admin.position.index', $jobPost->id);
                
                $positionBtn    = '<a class="editButton btn btn-sm btn-success" href="'.$positionRoute.'">Positions
                                   </a>';

                $editAction     = '<a class="editButton btn btn-sm btn-primary" href="'.$editRoute.'">
                                   <i class="fas fa-edit"></i></a>';
                $deleteAction   = '<a class="btn btn-sm btn-danger" href="javascript:void(0)"
                                   data-id="'.$jobPost->id.'" id="deleteAdminBtn""> 
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

                return '<div class="d-flex gap-3"> '.$positionBtn.$editAction.$deleteAction.'</div>';

            })
            ->rawColumns(['action', 'status'])
            ->make(true);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pages.job_post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        dd($request->all());
        $jobPost = new JobPost();
        $jobPost->title = $request->title;
        $jobPost->short_desc = $request->short_desc;
        $jobPost->long_desc = $request->long_desc;
        $jobPost->deadline = $request->deadline;
        $jobPost->additional_text = $request->additional_text;
        $jobPost->exam_date = $request->exam_date;
        $jobPost->exam_time = $request->exam_time;
        $jobPost->exam_instructions = $request->exam_instructions;
        
        if ($request->hasFile('img')) {
            
            $file = $request->file('img');
            $filename = time().uniqid().$file->getClientOriginalExtension();
            $file->move(public_path('backend/upload/job_post/'), $filename);
            $jobPost->img ='backend/upload/job_post/'. $filename;
            
        }
        
        $jobPost->save();
        
        return redirect()->route('admin.jobpost.index')->with('success', 'Job Post Created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(JobPost $jobPost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobPost $jobPost)
    {
        return view('backend.pages.job_post.edit', compact('jobPost'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JobPost $jobPost)
    {
        $jobPost->title = $request->title;
        $jobPost->short_desc = $request->short_desc;
        $jobPost->long_desc = $request->long_desc;
        $jobPost->deadline = $request->deadline;
        $jobPost->additional_text = $request->additional_text;
        $jobPost->exam_date = $request->exam_date;
        $jobPost->exam_time = $request->exam_time;
        $jobPost->exam_instructions = $request->exam_instructions;
        
        if ($request->hasFile('img')) {
            
            if ($jobPost->img && file_exists(public_path($jobPost->img))) {
                unlink(public_path($jobPost->img));
            }
            
            $file = $request->file('img');
            $filename = time().uniqid().$file->getClientOriginalExtension();
            $file->move(public_path('backend/upload/job_post/'), $filename);
            $jobPost->img ='backend/upload/job_post/'. $filename;
            
        }
        
        $jobPost->save();
        
        return redirect()->route('admin.jobpost.index')->with('success', 'Job Post Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobPost $jobPost)
    {
        $jobPost->delete();

        return response()->json(['status' => 'success','message' => 'Job Post Deleted successfully'], 200);
    }

    public function changeJobPostStatus(Request $request)
    {
        $id = $request->id;
        $status = $request->status;

        if ($status == 1) {
            $stat = 0;
        } else {
            $stat = 1;
        }

        $page = JobPost::findOrFail($id);
        $page->status = $stat;
        $page->save();

        return response()->json(['message' => 'success', 'status' => $stat, 'id' => $id]);
    }
    
    
}
