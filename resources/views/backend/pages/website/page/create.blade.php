@extends('backend.layout.master')

@push('backendCss')


@endpush

@section ('contents')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Create New Page</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                        <li class="breadcrumb-item active">Create Page</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <form method="post" action="{{route('admin.page.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-center">Page Information</h4>

                    </div>
                    <div class="card-body p-4">

                        <div class="row">
                         
                            <div class="col-lg-6">
                                <div>
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Page Name *</label>
                                        <input class="form-control" type="text" placeholder="Page Name"
                                               id="name" name="name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Page Title *</label>
                                        <input class="form-control" type="text" placeholder="Page Title"
                                               id="name" name="title" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="type" class="form-label">Page Type *</label>
                                        <select id="type" class="form-select" name="type">
                                            <option value="static">Static</option>
                                            <option value="dynamic">Dynamic</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="img" class="form-label">Image (565 × 575 px)</label>
                                        <input class="form-control" type="file" id="img" name="img">
                                    </div>
                                    <div class="mb-3">
                                        <label for="short_desc" class="form-label">Short Description</label>
                                        <textarea id="short_desc" name="short_desc" class="form-control"></textarea>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="pageStatus" class="form-label">Status *</label>
                                        <select id="pageStatus" class="form-select" name="status">
                                            <option value="1" selected>Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                    
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="meta_title" class="form-label">Meta Title</label>
                                    <input class="form-control" type="text" placeholder="Meta Title"
                                           id="meta_title" name="meta_title">
                                </div>
                                <div class="mb-3">
                                    <label for="meta_keyword" class="form-label">Meta Keywords</label>
                                    <input class="form-control" type="text" placeholder="Enter Meta Keywords"
                                           id="meta_keyword" name="meta_keywords">
                                </div>
                                <div class="mb-3">
                                    <label for="meta_desc" class="form-label">Meta Description</label>
                                    <textarea id="meta_desc" name="meta_desc" class="form-control"></textarea>
                                </div>
                                <div>
                                    <div class="mb-3">
                                        <label for="meta_img" class="form-label">Meta Image</label>
                                        <input class="form-control" type="file" id="meta_img" name="meta_img">
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div> <!-- end col -->
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-center">Long Description *</h4>

                    </div>
                    <div class="card-body p-4">

                        <div class="row">
                            <div class="col-lg-12">
                                <div>
                                    <div class="mb-3">

                                        <textarea id="page_desc" name="long_desc" class="form-control"></textarea>
                                    </div>
                                </div>

                            </div>


                        </div>
                        <div class="text-center mt-4 d-grid">
                            <button type="submit" class="btn  btn-primary">Update</button>
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


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        $(document).ready(function () {

            ClassicEditor
                .create(document.querySelector('#page_desc'))
                .catch(error => {
                    console.error(error);
                });
        });


    </script>
@endpush