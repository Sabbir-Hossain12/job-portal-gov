<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdmitCard;
use App\Models\JobApplication;
use Illuminate\Http\Request;

class AdmitCardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function previewAdminCard(string $id)
    {
        $jobApplications = JobApplication::where('id', $id)->with('admitCard')->first();
        
        return view('backend.pages.admit_card.preview', compact('jobApplications'));
    }

    /**
     * Show the form for creating a new resource.
     */
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
    public function show(AdmitCard $admitCard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AdmitCard $admitCard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AdmitCard $admitCard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AdmitCard $admitCard)
    {
        //
    }
}
