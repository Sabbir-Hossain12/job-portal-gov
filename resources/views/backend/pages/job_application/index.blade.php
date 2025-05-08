@extends('backend.layout.master')

@push('backendCss')
    {{--    <meta name="csrf_token" content="{{ csrf_token() }}" />--}}

    <link href="{{asset('backend')}}/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css"
          rel="stylesheet" type="text/css">
    <link href="{{asset('backend')}}/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css"
          rel="stylesheet" type="text/css">

@endpush

@section('contents')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Job Applications for <span
                            class="text-primary">{{ $position->title }} </span></h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                        <li class="breadcrumb-item active">Job Applications</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    {{-- Table Starts--}}

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">

                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Job Applications</h4>

                        <div class="d-flex gap-2">
                            <a class="btn btn-danger" id="bulkAdmitCardIssue" href="javascript: void(0);">
                                Issue Admin Card
                            </a>
                            
                            {{--                       @can('Create Admin')--}}
                            {{--                       @if(Auth::guard('admin')->user()->can('Create Admin'))--}}
                            <a class="btn btn-primary" href="{{route('admin.jobapplication.create', $position->id)}}">
                                Create Application
                            </a>
                        </div>
                        {{--                        @endcan--}}
                        {{--                        @endif--}}
                    </div>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table mb-0  nowrap w-100 dataTable no-footer dtr-inline" id="adminTable">
                            <thead>
                            <tr>
                                <th><input type="checkbox" id="select-all"></th>
                                <th>SL</th>
                                <th>Photo</th>
                                <th>Candidate info</th>
                                <th>Status</th>
                                <th>Payment Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>

                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>

    {{--    Table Ends--}}

@endsection

@push('backendJs')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{asset('backend')}}/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('backend')}}/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

    <script>

        $(document).ready(function () {

            var token = $("input[name='_token']").val();

            //Show Data through Datatable 
            let adminTable = $('#adminTable').DataTable({
                order: [
                    [0, 'asc']
                ],
                processing: true,
                serverSide: true,
                {{--ajax: "{{url('/admin/data')}}",--}}
                ajax: "{{route('admin.jobapplication.index',$position->id)}}",
                // pageLength: 30,

                columns: [
                    { data: 'checkbox', name: 'checkbox', orderable: false, searchable: false },
                    {
                        data: 'id',
                    },

                    {
                        data: 'img',
                        render: function (data, type, row) {
                            return '<img src="{{ asset('') }}' + data + '" width="70" height="70" alt="img" class="rounded-circle"/>';
                        }
                    },

                    {
                        data: 'candidate_name',

                    },
                    {
                        data: 'status',
                        name: 'Status',
                        orderable: false,
                        searchable: false,
                    },

                    {
                        data: 'payment_status',
                        render: function (data, type, row) {

                            return data == 'success'
                                ? '<span class="badge bg-success">Success</span>'
                                : `<span class="badge bg-danger"> ${data}</span>`;
                        },
                        orderable: false,
                        searchable: false,
                    },

                    {
                        data: 'action',
                        name: 'Actions',
                        orderable: false,
                        searchable: false
                    },
                ]
            });


            // Delete Post
            $(document).on('click', '#deleteAdminBtn', function () {
                let id = $(this).data('id');

                swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this !",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Yes, delete it!"
                })
                    .then((result) => {
                        if (result.isConfirmed) {

                            $.ajax({
                                type: 'DELETE',

                                url: "{{ url('job-applications') }}/" + id,
                                data: {
                                    '_token': token
                                },
                                success: function (res) {
                                    Swal.fire({
                                        title: "Deleted!",
                                        text: "Position has been deleted.",
                                        icon: "success"
                                    });

                                    adminTable.ajax.reload();
                                },
                                error: function (err) {
                                    console.log('error')
                                }
                            })

                        } else {
                            swal.fire('Your Data is Safe');
                        }

                    })
            })

            // Change Post Status
            $(document).on('click', '#adminStatus', function () {
                let id = $(this).data('id');
                let status = $(this).data('status')
                console.log(id + status)
                $.ajax(
                    {
                        type: 'post',
                        url: "{{route('admin.jobapplication.status')}}",
                        data: {
                            '_token': token,
                            id: id,
                            status: status

                        },
                        success: function (res) {
                            adminTable.ajax.reload();

                            if (res.status == 1) {

                                swal.fire(
                                    {
                                        title: 'Status Changed to Active',
                                        icon: 'success'
                                    })
                            } else {
                                swal.fire(
                                    {
                                        title: 'Status Changed to Inactive',
                                        icon: 'success'
                                    })

                            }
                        },
                        error: function (err) {
                            console.log(err)
                        }
                    }
                )
            })
            
            //select all
            $('#select-all').on('click', function(){
                $('input[name="selected_ids[]"]').prop('checked', this.checked);
            });
            
            //Bulk Admit Card Issue
            $(document).on('click', '#bulkAdmitCardIssue', function () {

                let selectedIds = [];

                $('input[name="selected_ids[]"]:checked').each(function () {
                    selectedIds.push($(this).val());
                });

                if (selectedIds.length === 0) {
                    alert('Please select at least one record to issue admit cards.');
                } else {
                    alert('Selected IDs: ' + selectedIds.join(', '));
                    // OR console.log(selectedIds);
                }
            })
        });
    </script>

@endpush