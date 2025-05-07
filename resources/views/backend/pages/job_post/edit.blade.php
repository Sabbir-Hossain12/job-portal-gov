@extends('backend.layout.master')

@push('backendCss')
    <link href="{{asset('backend')}}/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css"
          rel="stylesheet" type="text/css">
@endpush

@section('contents')
    {{--    Form Starts--}}
    <form method="post" action="{{route('admin.jobpost.update',$jobPost->id)}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-center">Job Post</h4>

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

                                        @if(isset($jobPost)) 
                                        <img id="bLogoImgPrev" class="mt-1" src="{{ asset($jobPost->img) }}"
                                             height="60px" width="200px" alt=""/>
                                        @endif
                                    </div>



                                    <div class="mb-3">
                                        <label for="title" class="form-label">Job Title *</label>
                                        <input class="form-control" type="text" name="title"
                                               placeholder=""
                                               id="title" value="{{ $jobPost->title ??  old ('title') }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="deadline" class="form-label">Deadline *</label>
                                        <input class="form-control" type="date" name="deadline" id="deadline" value="{{ $jobPost->deadline ?? old ('deadline') }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="exam_date" class="form-label">Exam Date</label>
                                        <input class="form-control" type="date" name="exam_date" id="exam_date" value="{{ $jobPost->exam_date ?? old ('exam_date') }}" required>
                                    </div>




                                    <div class="mb-3">
                                        <label for="short_desc" class="form-label">Short Description *</label>
                                        <textarea id="short_desc" name="short_desc"
                                                  class="form-control" required>{{ $jobPost->short_desc ?? old('short_desc') }}
                                        </textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="long_desc" class="form-label">Long Description *</label>
                                        <textarea id="long_desc" name="long_desc"
                                                  class="form-control ckeditor" required>{{ $jobPost->long_desc ?? old('long_desc') }}
                                        </textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mt-3 mt-lg-0">
                                    <div class="mb-3">
                                        <label for="additional_text" class="form-label">Additional Text</label>
                                        <textarea id="additional_text" name="additional_text"
                                                  class="form-control ckeditor">{{ $jobPost->additional_text ?? old('additional_text') }}</textarea>
                                    </div>
                                </div>

                                <div class="mt-3 mt-lg-0">
                                    <div class="mb-3">
                                        <label for="exam_time" class="form-label">Exam Time</label>
                                        <input type="text" id="exam_time" name="exam_time"
                                               class="form-control" value="{{ $jobPost->exam_time ?? old ('exam_time') }}">
                                    </div>
                                </div>

                                <div class="mt-3 mt-lg-0">
                                    <div class="mb-3">
                                        <label for="exam_instructions" class="form-label">Exam Instructions</label>
                                        <textarea id="exam_instructions" name="exam_instructions"
                                                  class="form-control ckeditor">{{ $jobPost->exam_instructions ?? old('exam_instructions') }}</textarea>
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