<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Basicinfo;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class BasicinfoController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:View Settings', only: ['index','store','update']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $basicInfo= Basicinfo::first();
        return view('backend.pages.website.basic-info',compact('basicInfo'));
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
//      dd($request->all());
        $basicInfo= new Basicinfo();
        $basicInfo->site_name=$request->site_name;
        $basicInfo->department_name=$request->department_name;
        $basicInfo->phone_1=$request->phone_1;
        $basicInfo->phone_2=$request->phone_2;
        $basicInfo->mail=$request->mail;
        $basicInfo->address=$request->address;
        $basicInfo->fb_link=$request->fb_link;
        $basicInfo->insta_link=$request->insta_link;
        $basicInfo->twitter_link=$request->twitter_link;
        $basicInfo->youtube_link=$request->youtube_link;
        $basicInfo->vimeo_link=$request->vimeo_link;
        $basicInfo->linkedin_link=$request->linkedin_link;
        $basicInfo->skype_link=$request->skype_link;
        $basicInfo->about_text=$request->about_text;
        $basicInfo->copyright_text=$request->copyright_text;
        $basicInfo->meta_title=$request->meta_title;
        $basicInfo->meta_desc=$request->meta_desc;
        $basicInfo->meta_keyword=$request->meta_keyword;
        $basicInfo->opening_hours_text=$request->opening_hours_text;
        $basicInfo->signatory_name = $request->signatory_name;
        $basicInfo->signatory_designation = $request->signatory_designation;
        $basicInfo->signatory_organization = $request->signatory_organization;
        
        
        if ($request->hasFile('dark_logo')) {
            
            $file = $request->file('dark_logo');
            $filename = time() .uniqid(). '.' . $file->getClientOriginalExtension();
            $file->move('backend/upload/logo/', $filename);
            $basicInfo->dark_logo ='backend/upload/logo/' . $filename;
        }
        
        if ($request->hasFile('light_logo')) {
            
            $file = $request->file('light_logo');
            $filename = time() .uniqid(). '.' . $file->getClientOriginalExtension();
            $file->move('backend/upload/logo/', $filename);
            $basicInfo->light_logo ='backend/upload/logo/' . $filename;
        }
        
        if ($request->hasFile('meta_image')) {
            
            $file = $request->file('meta_image');
            $filename = time() .uniqid(). '.' . $file->getClientOriginalExtension();
            $file->move('backend/upload/meta/', $filename);
            $basicInfo->meta_image ='backend/upload/meta/' . $filename;
        }
        
        if ($request->hasFile('fav_icon')) {
            
            $file = $request->file('fav_icon');
            $filename = time() .uniqid(). '.' . $file->getClientOriginalExtension();
            $file->move('backend/upload/favIcon/', $filename);
            $basicInfo->fav_icon ='backend/upload/favIcon/' . $filename;
        }

        if ($request->hasFile('signatory_signature')) {
            
            $file = $request->file('signatory_signature');
            $filename = time() .uniqid(). '.' . $file->getClientOriginalExtension();
            $file->move('backend/upload/signature/', $filename);
            $basicInfo->signatory_signature ='backend/upload/signature/' . $filename;
        }
        
       $save= $basicInfo->save();

        if ($save) {
//            Toastr::success('Success','Basic Info Stored Successfully.');
            return redirect()->back()->with('success', 'Basic Info Added Successfully');
        }

        return redirect()->back();
        
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $basicInfo= Basicinfo::first();
        $basicInfo->site_name=$request->site_name;
        $basicInfo->department_name=$request->department_name;
        $basicInfo->phone_1=$request->phone_1;
        $basicInfo->phone_2=$request->phone_2;
        $basicInfo->mail=$request->mail;
        $basicInfo->address=$request->address;
        $basicInfo->fb_link=$request->fb_link;
        $basicInfo->insta_link=$request->insta_link;
        $basicInfo->twitter_link=$request->twitter_link;
        $basicInfo->youtube_link=$request->youtube_link;
        $basicInfo->vimeo_link=$request->vimeo_link;
        $basicInfo->linkedin_link=$request->linkedin_link;
        $basicInfo->skype_link=$request->skype_link;
        $basicInfo->about_text=$request->about_text;
        $basicInfo->copyright_text=$request->copyright_text;
        $basicInfo->meta_title=$request->meta_title;
        $basicInfo->meta_desc=$request->meta_desc;
        $basicInfo->meta_keyword=$request->meta_keyword;
        $basicInfo->opening_hours_text=$request->opening_hours_text;
        $basicInfo->signatory_name = $request->signatory_name;
        $basicInfo->signatory_designation = $request->signatory_designation;
        $basicInfo->signatory_organization = $request->signatory_organization;
        
        
        if ($request->hasFile('dark_logo')) {
            
            if ($basicInfo->dark_logo && file_exists(public_path($basicInfo->dark_logo))) {
                
                unlink(public_path($basicInfo->dark_logo));
            }
            
            $file = $request->file('dark_logo');
            $filename = time() .uniqid(). '.' . $file->getClientOriginalExtension();
            $file->move('backend/upload/logo/', $filename);
            $basicInfo->dark_logo ='backend/upload/logo/' . $filename;
        }
        
        if ($request->hasFile('light_logo')) {
            
            if ($basicInfo->light_logo && file_exists(public_path($basicInfo->light_logo))) {
                
                unlink(public_path($basicInfo->light_logo));
            }
            
            $file = $request->file('light_logo');
            $filename = time() .uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move('backend/upload/logo/', $filename);
            $basicInfo->light_logo ='backend/upload/logo/' . $filename;
        }
        
        if ($request->hasFile('meta_image')) {
            
            if ($basicInfo->meta_image && file_exists(public_path($basicInfo->meta_image))) {
                
                unlink(public_path($basicInfo->meta_image));
            }
            
            $file = $request->file('meta_image');
            $filename = time() .uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move('backend/upload/meta/', $filename);
            $basicInfo->meta_image ='backend/upload/meta/' . $filename;
        }
        
          if ($request->hasFile('fav_icon')) {
              
                if ($basicInfo->fav_icon && file_exists(public_path($basicInfo->fav_icon))) {
                
                unlink(public_path($basicInfo->fav_icon));
            }
            
            $file = $request->file('fav_icon');
            $filename = time() .uniqid(). '.' . $file->getClientOriginalExtension();
            $file->move('backend/upload/favIcon/', $filename);
            $basicInfo->fav_icon ='backend/upload/favIcon/' . $filename;
        }

        if ($request->hasFile('signatory_signature')) {
            
            if ($basicInfo->signatory_signature && file_exists(public_path($basicInfo->signatory_signature))) {
                
                unlink(public_path($basicInfo->signatory_signature));
            }
            
            $file = $request->file('signatory_signature');
            $filename = time() .uniqid(). '.' . $file->getClientOriginalExtension();
            $file->move('backend/upload/signature/', $filename);
            $basicInfo->signatory_signature ='backend/upload/signature/' . $filename;
        }
          
          
        
       $save= $basicInfo->save();

        if ($save) {

            return redirect()->back()->with('success', 'Basic Info Updated Successfully');
        }

        return redirect()->back()->with('error', 'Basic Info Updated Failed');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
