@extends('backend.layout.master')

@push('backendCss')
    <link href="{{asset('backend')}}/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css"
          rel="stylesheet" type="text/css">

@endpush

@section('contents')
    {{--    Form Starts--}}
    <form method="post" action="{{route('admin.jobapplication.update',$jobApplication->id)}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-center">Update Job Application</h4>

                    </div>
                    <div class="card-body p-4">

                        <div class="row">
                            <div class="col-lg-6">
                                <div>
                                   
                                    <div class="mb-3">
                                        <label for="img" class="form-label">Photo (300 X 300px) * </label>
                                        <input oninput="bLogoImgPrev.src=window.URL.createObjectURL(this.files[0])"
                                               class="form-control" type="file" name="img"
                                               id="img">

                                        @if(isset($jobApplication->img)) 
                                        <img id="bLogoImgPrev" class="mt-1" src="{{asset($jobApplication->img)}}"
                                             height="300" width="300" alt=""/>
                                        @endif
                                    </div>

                                    <div class="mb-3">
                                        <label for="signature" class="form-label">Signature (300 X 80px) *</label>
                                        <input oninput="signatureImgPrev.src=window.URL.createObjectURL(this.files[0])"
                                               class="form-control" type="file" name="signature"
                                               id="signature">

                                        @if(isset($jobApplication->signature))
                                        <img id="signatureImgPrev" class="mt-1" src="{{asset($jobApplication->signature)}}"
                                             height="80" width="300" alt=""/>
                                        @endif
                                    </div>

                                    <div class="mb-3">
                                        <label for="payment_status" class="form-label">Payment Status *</label>
                                        <select class="form-control" name="payment_status" id="payment_status" required>
                                            <option value="pending" @if($jobApplication->payment_status == 'pending') selected @endif>Pending</option>
                                            <option value="success" @if($jobApplication->payment_status == 'success') selected @endif>Success</option>
                                            <option value="failed" @if($jobApplication->payment_status == 'failed') selected @endif>Failed</option>
                                        </select>
                                    </div>


                                </div>
                            </div>

                            <div class="col-lg-6">



                                <div class="mb-3">
                                    <label for="candidate_name" class="form-label">Candidate Name *</label>
                                    <input class="form-control" type="text" name="candidate_name"
                                           placeholder=""
                                           id="candidate_name" value="{{ $jobApplication->candidate_name ?? old ('candidate_name') }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="candidate_phone" class="form-label">Candidate Phone *</label>
                                    <input class="form-control" type="text" name="candidate_phone"
                                           placeholder=""
                                           id="candidate_phone" value="{{ $jobApplication->candidate_phone ?? old ('candidate_phone')}}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="candidate_email" class="form-label">Candidate Email</label>
                                    <input class="form-control" type="text" name="candidate_email"
                                           placeholder=""
                                           id="candidate_email" value="{{ $jobApplication->candidate_email ?? old ('candidate_email') }}">
                                </div>

                                <div class="mb-3">
                                    <label for="fathers_name" class="form-label">Fathers Name *</label>
                                    <input class="form-control" type="text" name="fathers_name"
                                           placeholder=""
                                           id="fathers_name" value="{{ $jobApplication->fathers_name ?? old ('fathers_name') }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="mothers_name" class="form-label">Mothers Name *</label>
                                    <input class="form-control" type="text" name="mothers_name"
                                           placeholder=""
                                           id="mothers_name" value="{{ $jobApplication->mothers_name ?? old ('mothers_name') }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="status" class="form-label">Status *</label>
                                    <select class="form-control d-block" name="status" id="status" required>
                                        <option value="1" @if($jobApplication->status == 1) selected @endif>Active</option>
                                        <option value="0" @if($jobApplication->status == 0) selected @endif>Inactive</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="applicant_status" class="form-label">Candidate Status *</label>
                                    <select class="form-control d-block" name="applicant_status" id="applicant_status" required>
                                        <option value="pending" @if($jobApplication->applicant_status == 'pending') selected @endif>Pending</option>
                                        <option value="approved" @if($jobApplication->applicant_status == 'approved') selected @endif>Approved</option>
                                        <option value="rejected" @if($jobApplication->applicant_status == 'rejected') selected @endif>Rejected</option>
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