<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobPost;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Yajra\DataTables\Facades\DataTables;

class PositionController extends Controller implements HasMiddleware 
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:View Position', only: ['index']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {
        $jobPost = JobPost::find($id);
        
        $positions = Position::query()->where('job_post_id', $id);
        
        if (\request()->ajax()) {
            return   DataTables::of($positions)
                ->addColumn('status', function ($position) {

//                if(Auth::guard('admin')->user()->can('Status Admin')) {
                    if ($position->status == 1) {
                        return ' <a class="status" id="adminStatus" href="javascript:void(0)"
                                               data-id="'.$position->id.'" data-status="'.$position->status.'"> <i
                                                        class="fa-solid fa-toggle-on fa-2x"></i>
                                            </a>';
                    } else {

                        return '<a class="status" id="adminStatus" href="javascript:void(0)"
                                               data-id="'.$position->id.'" data-status="'.$position->status.'"> <i
                                                        class="fa-solid fa-toggle-off fa-2x" style="color: grey"></i>
                                            </a>';

                    }
//                }

                })
                ->addColumn('action', function ($position) {

                    $editRoute      = route('admin.position.edit', $position->id);
                    $positionRoute  = route('admin.jobapplication.index', $position->id);

                    $positionBtn    = '<a class="editButton btn btn-sm btn-success" href="'.$positionRoute.'">Applications
                                   </a>';
                    
                    $editAction     = '<a class="editButton btn btn-sm btn-primary" href="'.$editRoute.'">
                                   <i class="fas fa-edit"></i></a>';
                    
                    $deleteAction   = '<a class="btn btn-sm btn-danger" href="javascript:void(0)"
                                   data-id="'.$position->id.'" id="deleteAdminBtn""> 
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
        
        return view('backend.pages.position.index', compact('jobPost'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {
        $jobPost = JobPost::find($id);
        return view('backend.pages.position.create', compact('jobPost'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        dd($request->all());
        $position = new Position();
        $position->job_post_id = $request->job_post_id;
        $position->title = $request->title;
        $position->vacancy = $request->vacancy;
        $position->vacancy_desc = $request->vacancy_desc;
        $position->qualifications = $request->qualifications;
        $position->minimum_age = $request->minimum_age;
        $position->salary = $request->salary;
        $position->exam_center = $request->exam_center;
        $position->save();
        
        return redirect()->route('admin.position.index', $request->job_post_id)->with('success', 'Position Created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Position $position, string $id)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $position = Position::find($id);
        return view('backend.pages.position.edit', compact('position'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,string $id)
    {
        $position = Position::find($id);
        $position->title = $request->title;
        $position->vacancy = $request->vacancy;
        $position->vacancy_desc = $request->vacancy_desc;
        $position->qualifications = $request->qualifications;
        $position->minimum_age = $request->minimum_age;
        $position->salary = $request->salary;
        $position->exam_center = $request->exam_center;
        $position->save();
        
        return redirect()->back()->with('success', 'Position Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Position $position, string $id)
    {
        Position::where('id', $id)->delete();
//      $position->delete();

        return response()->json(['status' => 'success','message' => 'Position Deleted successfully'], 200);
    }

    public function changePositionStatus(Request $request)
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
