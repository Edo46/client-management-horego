@extends('layouts.menu')

@section('title')
    Manage User
@endsection

@section('css')
    <link href="{{ url('dashboard/assets/libs/jquery-toast-plugin/jquery.toast.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ url('dashboard/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('dashboard/assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('dashboard/assets/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('dashboard/assets/libs/datatables.net-select-bs5/css//select.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('dashboard/assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('dashboard/assets/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('dashboard/assets/dropify/css/dropify.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('dashboard/assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Master</a></li>
                            <li class="breadcrumb-item active">App Master</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Manage User</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">User Data</h4>
                        <p class="text-muted font-13 mb-4">
                            Slide the table if data is to long
                        </p>

                        <table id="datatable" class="table dt-responsive nowrap w-100">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- container -->

    <div id="input_modal" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="standard-modalLabel">User Form</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form_input" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-6 col-sm-12">
                                <div class="mb-3">
                                    <label class="form-label" for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-12">
                                <div class="mb-3">
                                    <label class="form-label" for="email">Email</label>
                                    <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email">
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-12">
                                <div class="mb-3">
                                    <label class="form-label" for="person">Can Manage Person Module</label>
                                    <select class="form-control" id="person" name="person" >
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" aksi="input" id="submit_form">Save</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div id="modal_permission" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="standard-modalLabel">Organisation List</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table id="permission_datatable" class="table dt-responsive nowrap w-100">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Organisation</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div id="modal_input_permission" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="standard-modalLabel">Organisation List</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form_permission" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-12 col-sm-12">
                                <div class="mb-3">
                                    <label class="form-label" for="organisation_id">Organisation</label>
                                    <select id="organisation_id" name="organisation_id" class="select2 form-select form-control" data-allow-clear="true" style="width: 100% !important;">
                                        <option>--Select--</option>
                                    </select>
                                    <input type="hidden" id="user_id" name="user_id">
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" aksi="input" id="submit_form_permission">Save</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection
@section('js')
    <script src="{{ url('dashboard/assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('dashboard/assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ url('dashboard/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ url('dashboard/assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ url('dashboard/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ url('dashboard/assets/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ url('dashboard/assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ url('dashboard/assets/libs/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{ url('dashboard/assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ url('dashboard/assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ url('dashboard/assets/libs/datatables.net-select/js/dataTables.select.min.js') }}"></script>
    <script src="{{ url('dashboard/assets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ url('dashboard/assets/libs/pdfmake/build/vfs_fonts.js') }}"></script>

    <script src="{{ url('dashboard/assets/libs/jquery-toast-plugin/jquery.toast.min.js') }}"></script>
    <script src="{{ url('dashboard/assets/libs/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="{{ url('dashboard/assets/libs/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ url('dashboard/assets/dropify/js/dropify.min.js') }}"></script>
    <script src="{{ url('dashboard/assets/libs/select2/js/select2.min.js') }}"></script>


    <script type="text/javascript">
        function loadData() {
            $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax : {
                    url : "{{ url('/manage-user/data') }}",
                    type : "GET"
                },
                columns : [
                    { "data": "DT_RowIndex" },
                    { "data": "name" },
                    { "data": "email" },
                    { "data": "action" },
                ],
                columnDefs: [
                    {
                        orderable: false,
                        searchable: false,
                        width: "20px",
                        targets: [0]
                    },
                    {
                        orderable: false,
                        width: "150px",
                        targets: [3]
                    },

                ],
                dom:
                    '<"row mx-1"' +
                    '<"col-sm-12 col-md-3" l>' +
                    '<"col-sm-12 col-md-9"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-md-end justify-content-center flex-wrap me-1"<"me-3"f>B>>' +
                    '>t' +
                    '<"row mx-2"' +
                    '<"col-sm-12 col-md-6"i>' +
                    '<"col-sm-12 col-md-6"p>' +
                    '>',

                buttons: [
                    {
                        text: 'Add New',
                        className: 'btn btn-primary waves-effect waves-light',
                        attr: {
                            'data-bs-toggle': 'modal',
                            'data-bs-target': '#input_modal'
                        },
                        init: function (api, node, config) {
                            $(node).removeClass('btn-secondary');
                        }
                    },
                ],

                order: [[1, 'desc']],
                language: {
                    sLengthMenu: '_MENU_',
                    search: 'Search',
                    searchPlaceholder: 'Search..'
                },
                scrollX: true,
                scrollY: '350px',
                scrollCollapse: true,
                responsive: false,
            });
        }

        function loadPermissionList() {
            $('#permission_datatable').DataTable().destroy();
            $('#permission_datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax : {
                    url : "{{ url('/manage-assigned/data') }}",
                    type : "GET",
                    data : {
                        user_id : $('#user_id').val()
                    }
                },
                columns : [
                    { "data": "DT_RowIndex" },
                    { "data": "organisation.name" },
                    { "data": "action" },
                ],
                columnDefs: [
                    {
                        orderable: false,
                        searchable: false,
                        width: "20px",
                        targets: [0]
                    },
                    {
                        orderable: false,
                        width: "50px",
                        targets: [2]
                    },

                ],
                dom:
                    '<"row mx-1"' +
                    '<"col-sm-12 col-md-3" l>' +
                    '<"col-sm-12 col-md-9"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-md-end justify-content-center flex-wrap me-1"<"me-3"f>B>>' +
                    '>t' +
                    '<"row mx-2"' +
                    '<"col-sm-12 col-md-6"i>' +
                    '<"col-sm-12 col-md-6"p>' +
                    '>',

                buttons: [
                    {
                        text: 'Add New',
                        className: 'btn btn-primary waves-effect waves-light',
                        attr: {
                            'data-bs-toggle': 'modal',
                            'data-bs-target': '#modal_input_permission'
                        },
                        init: function (api, node, config) {
                            $(node).removeClass('btn-secondary');
                        }
                    },
                ],

                order: [[1, 'desc']],
                language: {
                    sLengthMenu: '_MENU_',
                    search: 'Search',
                    searchPlaceholder: 'Search..'
                },
                scrollX: true,
                scrollY: '350px',
                scrollCollapse: true,
                responsive: false,
            });

            $('#permission_datatable tbody').on('click', '#delete', function (e) {
                var table = $('#permission_datatable').DataTable();
                var data = table.row( $(this).parents('tr') ).data();
                console.log(data)
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: !0,
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel!",
                    confirmButtonClass: "btn btn-success mt-2",
                    cancelButtonClass: "btn btn-danger ms-2 mt-2",
                    buttonsStyling: !1,
                }).then(function (e) {
                    e.value
                        ?
                        $.ajax({
                            url: "{{ url('/manage-assigned/delete/') }}/" + data.id,
                            type: "post",
                            data: {
                                "_token": "{{ csrf_token() }}",
                            },
                            cache: false,
                            success: function (response) {
                                var pesan = JSON.parse(response);
                                Swal.fire({
                                    title: "Deleted!",
                                    text: pesan.success,
                                    icon: "success",
                                    confirmButtonColor: "#4a4fea"
                                })
                                table.ajax.reload();
                            },
                            failure: function (response) {
                                var pesan = JSON.parse(response);
                                Swal.fire({
                                    title: "Error!",
                                    text: pesan.error,
                                    icon: "error",
                                    confirmButtonColor: "#4a4fea"
                                })
                            }
                        })
                        : e.dismiss === Swal.DismissReason.cancel;
                });
            });
        }

        function resetForm() {
            $('#form_input input[type="text"]').val("");
            $('#form_input input[type="file"]').val("");
        }

        $(window).on('load', function () {
            loadData();

            $("#organisation_id").select2({
                dropdownParent : $("#modal_input_permission .modal-body"),
                placeholder : '--Select--'
            });
            $.ajax({
                url: "{{ url('manage-organisation/list') }}",
                dataType: "json",
                type: "GET",
                success: function(data) {
                    var organisation = jQuery.parseJSON(JSON.stringify(data));
                    $.each(organisation, function(k, v) {
                        $('#organisation_id').append($('<option>', {value:v.id}).text(v.name))
                    });

                },
                error: function(data) {
                    return false;
                }
            });

            $('#submit_form').click(function () {
                var aksi = $("#submit_form").attr("aksi");
                if(aksi=="input"){
                    $.ajax({
                        url: "{{ url('/manage-user/input') }}",
                        type: "post",
                        data: new FormData($('#form_input')[0]),
                        async: false,
                        cache: false,
                        contentType: false,
                        processData: false,

                        success: function (response) {
                            var message = JSON.parse(response);
                            if(message.error != null){
                                Swal.fire({
                                    title: "Error!",
                                    text: message.error,
                                    icon: "error",
                                    confirmButtonColor: "#ea4a4a"
                                })
                                $('#datatable').DataTable().ajax.reload();
                            }else if(message.success != null){
                                Swal.fire({
                                    title: "Saved!",
                                    text: message.success,
                                    icon: "success",
                                    confirmButtonColor: "#4a4fea"
                                })
                                resetForm();
                                $('#input_modal').modal('toggle');
                                $('#datatable').DataTable().ajax.reload();
                            }else {
                                Swal.fire({
                                    title: "Error!",
                                    text: 'Contact your administrator',
                                    icon: "error",
                                    confirmButtonColor: "#ea4a4a"
                                })
                            }
                        }
                    });
                }else if(aksi=="edit"){
                    var id_data = $("#submit_form").attr("iddata");
                    $.ajax({
                        url: "{{ url('/manage-user/edit') }}/"+id_data,
                        type: "post",
                        data: new FormData($('#form_input')[0]),
                        async: false,
                        cache: false,
                        contentType: false,
                        processData: false,

                        success: function (response) {
                            var message = JSON.parse(response);
                            if(message.error != null){
                                Swal.fire({
                                    title: "Error!",
                                    text: message.error,
                                    icon: "error",
                                    confirmButtonColor: "#ea4a4a"
                                })
                                $('#datatable').DataTable().ajax.reload();
                            }else if(message.success != null){
                                Swal.fire({
                                    title: "Saved!",
                                    text: message.success,
                                    icon: "success",
                                    confirmButtonColor: "#4a4fea"
                                })
                                resetForm();
                                $('#input_modal').modal('toggle');
                                $('#datatable').DataTable().ajax.reload();
                                $('#submit_form').attr("data-aksi","input");
                            }else {
                                Swal.fire({
                                    title: "Error!",
                                    text: 'Contact your administrator',
                                    icon: "error",
                                    confirmButtonColor: "#ea4a4a"
                                })
                            }
                        }
                    });
                }
            });

            $('#submit_form_permission').click(function () {
                $.ajax({
                    url: "{{ url('/manage-assigned/input') }}",
                    type: "post",
                    data: new FormData($('#form_permission')[0]),
                    async: false,
                    cache: false,
                    contentType: false,
                    processData: false,

                    success: function (response) {
                        var message = JSON.parse(response);
                        if(message.error != null){
                            Swal.fire({
                                title: "Error!",
                                text: message.error,
                                icon: "error",
                                confirmButtonColor: "#ea4a4a"
                            })
                        }else if(message.success != null){
                            Swal.fire({
                                title: "Saved!",
                                text: message.success,
                                icon: "success",
                                confirmButtonColor: "#4a4fea"
                            })
                            $('#modal_input_permission').modal('toggle');
                            $('#modal_permission').modal('toggle');
                            loadPermissionList();
                        }else {
                            Swal.fire({
                                title: "Error!",
                                text: 'Contact your administrator',
                                icon: "error",
                                confirmButtonColor: "#ea4a4a"
                            })
                        }
                    }
                });
            });

            $('#datatable tbody').on('click', '#edit', function (e) {
                var table = $('#datatable').DataTable();
                var data = table.row( $(this).parents('tr') ).data();
                $('#name').val(data.name).change();
                $('#email').val(data.email).change();
                $('#person').val(data.restriction.person).trigger('change');
                $('#organisation').val(data.restriction.organisation).trigger('change');
                $("#submit_form").attr("aksi","edit");
                $('#submit_form').attr("iddata",data.id);
                $('#input_modal').modal('toggle');
            });

            $('#datatable tbody').on('click', '#assigned', function (e) {
                var table = $('#datatable').DataTable();
                var data = table.row( $(this).parents('tr') ).data();

                $('#user_id').val(data.id);
                loadPermissionList();
                $('#modal_permission').modal('toggle');
            });

            $('#datatable tbody').on('click', '#delete', function (e) {
                var table = $('#datatable').DataTable();
                var data = table.row( $(this).parents('tr') ).data();
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: !0,
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel!",
                    confirmButtonClass: "btn btn-success mt-2",
                    cancelButtonClass: "btn btn-danger ms-2 mt-2",
                    buttonsStyling: !1,
                }).then(function (e) {
                    e.value
                        ?
                        $.ajax({
                            url: "{{ url('/manage-user/delete/') }}/" + data.id,
                            type: "post",
                            data: {
                                "_token": "{{ csrf_token() }}",
                            },
                            cache: false,
                            success: function (response) {
                                var pesan = JSON.parse(response);
                                Swal.fire({
                                    title: "Deleted!",
                                    text: pesan.success,
                                    icon: "success",
                                    confirmButtonColor: "#4a4fea"
                                })
                                table.ajax.reload();
                            },
                            failure: function (response) {
                                var pesan = JSON.parse(response);
                                Swal.fire({
                                    title: "Error!",
                                    text: pesan.error,
                                    icon: "error",
                                    confirmButtonColor: "#4a4fea"
                                })
                            }
                        })
                        : e.dismiss === Swal.DismissReason.cancel;
                });
            });

            $('.modal').on('shown.bs.modal', function () {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

            $('.modal').on('hidden.bs.modal', function () {
                resetForm();
                $("#submit_form").attr("aksi","input");
                $('#submit_form').removeAttr("iddata");
            });


        });
    </script>
@endsection
