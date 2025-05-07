@extends('backend.layout.master')

@push('backendCss')
    <link href="{{asset('backend')}}/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css"
          rel="stylesheet" type="text/css">

@endpush

@section('contents')
    {{--    Form Starts--}}
    <form method="post" action="{{route('admin.jobapplication.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="row">

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-center">Create Job Application for <span class="text-primary">{{ $position->title }} </span></h4>

                    </div>
                    <div class="card-body p-4">

                        <div class="row">
                            <div class="col-lg-6">
                                <div>
                                    <input type="hidden" name="position_id" value="{{ $position->id }}">
                                    <input type="hidden" name="job_post_id" value="{{ $position->job_post_id }}">
                                    
                                    <div class="mb-3">
                                        <label for="img" class="form-label">Photo (300 X 300px) * </label>
                                        <input oninput="bLogoImgPrev.src=window.URL.createObjectURL(this.files[0])"
                                               class="form-control" type="file" name="img"
                                               id="img" required>

                                        <img id="bLogoImgPrev" class="mt-1" src="https://273774.fs1.hubspotusercontent-na1.net/hub/273774/hubfs/act3/images/placeholder.jpg?width=1920&height=1080&name=placeholder.jpg"
                                             height="300" width="300" alt=""/>
                                    </div>

                                    <div class="mb-3">
                                        <label for="signature" class="form-label">Signature (300 X 80px) *</label>
                                        <input oninput="signatureImgPrev.src=window.URL.createObjectURL(this.files[0])"
                                               class="form-control" type="file" name="signature"
                                               id="signature">

                                        <img id="signatureImgPrev" class="mt-1" src="https://273774.fs1.hubspotusercontent-na1.net/hub/273774/hubfs/act3/images/placeholder.jpg?width=1920&height=1080&name=placeholder.jpg"
                                             height="80" width="300" alt=""/>
                                    </div>

                                    <div class="mb-3">
                                        <label for="payment_status" class="form-label">Payment Status *</label>
                                        <select class="form-control" name="payment_status" id="payment_status" required>
                                            <option value="pending">Pending</option>
                                            <option value="success">Success</option>
                                            <option value="failed">Failed</option>
                                        </select>
                                    </div>
                                    
                                    
                                </div>
                            </div>

                            <div class="col-lg-6">

                            

                                <div class="mb-3">
                                    <label for="candidate_name" class="form-label">Candidate Name *</label>
                                    <input class="form-control" type="text" name="candidate_name"
                                           placeholder=""
                                           id="candidate_name" value="{{ old ('candidate_name') ?? '' }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="candidate_phone" class="form-label">Candidate Phone *</label>
                                    <input class="form-control" type="text" name="candidate_phone"
                                           placeholder=""
                                           id="candidate_phone" value="{{ old ('candidate_phone') ?? '' }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="candidate_email" class="form-label">Candidate Email</label>
                                    <input class="form-control" type="text" name="candidate_email"
                                           placeholder=""
                                           id="candidate_email" value="{{ old ('candidate_email') ?? '' }}">
                                </div>

                                <div class="mb-3">
                                    <label for="fathers_name" class="form-label">Fathers Name *</label>
                                    <input class="form-control" type="text" name="fathers_name"
                                           placeholder=""
                                           id="fathers_name" value="{{ old ('fathers_name') ?? '' }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="mothers_name" class="form-label">Mothers Name *</label>
                                    <input class="form-control" type="text" name="mothers_name"
                                           placeholder=""
                                           id="mothers_name" value="{{ old ('mothers_name') ?? '' }}" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status *</label>
                                    <select class="form-control d-block" name="status" id="status" required>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="applicant_status" class="form-label">Candidate Status *</label>
                                    <select class="form-control d-block" name="applicant_status" id="applicant_status" required>
                                        <option value="pending">Pending</option>
                                        <option value="approved">Approved</option>
                                        <option value="rejected">Rejected</option>
                                    </select>
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