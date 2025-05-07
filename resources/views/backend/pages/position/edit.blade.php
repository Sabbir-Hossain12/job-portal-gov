@extends('backend.layout.master')

@push('backendCss')
    <link href="{{asset('backend')}}/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css"
          rel="stylesheet" type="text/css">
@endpush

@section('contents')
    {{--    Form Starts--}}
    <form method="post" action="{{ route('admin.position.update', $position->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-center">Update Position for <span class="text-primary">{{ $position->title }} </span></h4>
                    </div>
                    <div class="card-body p-4">

                        <div class="row">
                            <div class="col-lg-6">
                                <div>
                                    
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Position Title *</label>
                                        <input class="form-control" type="text" name="title"
                                               placeholder=""
                                               id="title" value="{{ $position->title ?? old ('title') }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="vacancy" class="form-label">Vacancy *</label>
                                        <input class="form-control" type="number" name="vacancy"
                                               placeholder=""
                                               id="vacancy" value="{{ $position->vacancy ?? old ('vacancy') }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="vacancy_desc" class="form-label">Vacancy Description </label>
                                        <textarea id="vacancy_desc" name="vacancy_desc"
                                                  class="form-control">{{ $position->vacancy_desc ?? old('vacancy_desc') }}
                                        </textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="qualifications" class="form-label">Qualifications </label>
                                        <textarea id="qualifications" name="qualifications"
                                                  class="form-control ckeditor" required>{{ $position->qualifications ?? old('qualifications') }}
                                       </textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mt-3 mt-lg-0">
                                    <div class="mb-3">
                                        <label for="exam_instructions" class="form-label">Exam Center</label>
                                        <input class="form-control" type="text" name="exam_center" id="exam_center" value="{{ $position->exam_center ?? old ('exam_center') }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="minimum_age" class="form-label">Minimum Age</label>
                                        <input class="form-control" type="number" name="minimum_age" id="minimum_age" value="{{ $position->minimum_age ?? old ('minimum_age') }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="salary" class="form-label">Salary</label>
                                        <input class="form-control" type="text" name="salary" id="salary" value="{{ $position->salary ?? old ('salary') ?? '' }}">
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
        // $(document).ready(function () {
        //
        //     $(document).ready(function () {
        //         $('.ckeditor').each(function () {
        //             ClassicEditor
        //                 .create(this)
        //                 .catch(error => {
        //                     console.error(error);
        //                 });
        //         });
        //     })
        // });
    </script>

@endpush