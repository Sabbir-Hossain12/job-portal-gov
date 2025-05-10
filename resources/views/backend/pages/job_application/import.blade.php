@extends('backend.layout.master')

@push('backendCss')
    <link href="{{asset('backend')}}/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css"
          rel="stylesheet" type="text/css">

@endpush

@section('contents')
    {{--    Form Starts--}}
    <form method="post" action="{{route('admin.import.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="row">

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-center">Import Data From Excel</h4>

                    </div>
                    <div class="card-body p-4">

                        <div class="row">
                            <div class="col-lg-6">
                                <div>
                                    <div class="mb-3">
                                        <label for="import_file" class="form-label">Upload Excel</label>
                                        <input class="form-control" type="file" name="import_file"
                                               id="import_file" required>
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