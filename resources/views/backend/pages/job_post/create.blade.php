@extends('backend.layout.master')

@push('backendCss')
    <link href="{{asset('backend')}}/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css"
          rel="stylesheet" type="text/css">

@endpush

@section('contents')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.jobpost.index') }}">Job Post</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin.jobpost.create') }}">Create Post</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    {{--    Form Starts--}}
                <form method="post" action="{{route('admin.jobpost.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title text-center">Create Job Post</h4>

                                </div>
                                <div class="card-body p-4">

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div>
                                                <div class="mb-3">
                                                    <label for="img" class="form-label">Image</label>
                                                    <input oninput="bLogoImgPrev.src=window.URL.createObjectURL(this.files[0])"
                                                           class="form-control" type="file" name="img"
                                                           id="img">
                                                    
                                                        <img id="bLogoImgPrev" class="mt-1" src="https://273774.fs1.hubspotusercontent-na1.net/hub/273774/hubfs/act3/images/placeholder.jpg?width=1920&height=1080&name=placeholder.jpg"
                                                             height="60px" width="200px" alt=""/>
                                                </div>

                                             

                                                <div class="mb-3">
                                                    <label for="title" class="form-label">Job Title *</label>
                                                    <input class="form-control" type="text" name="title"
                                                           placeholder=""
                                                           id="title" value="{{ old ('title') ?? '' }}" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="deadline" class="form-label">Deadline *</label>
                                                    <input class="form-control" type="date" name="deadline" id="deadline" value="{{ old ('deadline') ?? '' }}" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="exam_date" class="form-label">Exam Date</label>
                                                    <input class="form-control" type="date" name="exam_date" id="exam_date" value="{{ old ('exam_date') ?? '' }}" required>
                                                </div>
                                                
                                                


                                                <div class="mb-3">
                                                    <label for="short_desc" class="form-label">Short Description *</label>
                                                    <textarea id="short_desc" name="short_desc"
                                                              class="form-control" required>{{ old('short_desc') ?? '' }}
                                            
                                                    </textarea>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="long_desc" class="form-label">Long Description *</label>
                                                    <textarea id="long_desc" name="long_desc"
                                                              class="form-control ckeditor" required>{{ old('long_desc') ?? '' }}
                                            
                                                    </textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mt-3 mt-lg-0">
                                                <div class="mb-3">
                                                    <label for="additional_text" class="form-label">Additional Text</label>
                                                    <textarea id="additional_text" name="additional_text"
                                                              class="form-control ckeditor">{{ old('additional_text') ?? '' }}</textarea>
                                                </div>
                                            </div>
                                            
                                            <div class="mt-3 mt-lg-0">
                                                <div class="mb-3">
                                                    <label for="exam_time" class="form-label">Exam Time</label>
                                                    <input type="text" id="exam_time" name="exam_time"
                                                              class="form-control">
                                                </div>
                                            </div>

                                            <div class="mt-3 mt-lg-0">
                                                <div class="mb-3">
                                                    <label for="exam_instructions" class="form-label">Exam Instructions</label>
                                                    <textarea id="exam_instructions" name="exam_instructions"
                                                              class="form-control ckeditor">{{ old('exam_instructions') ?? '' }}</textarea>
                                                </div>
                                            </div>
                                            
                                        </div>

                                        <div class="text-center mt-4 d-grid">
                                            <button class="btn btn-primary">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div>
                 
                </form>
        @endsection

        @push('backendJs')
            {{--  CkEditor CDN  --}}
            <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
            <script>
                $(document).ready(function () {

                    $(document).ready(function () {
                        $('.ckeditor').each(function () {
                            ClassicEditor
                                .create(this)
                                .catch(error => {
                                    console.error(error);
                                });
                        });
                    })
                });
            </script>

        @endpush