@extends('layouts.admin');

@push('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
@push('ui')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
@endpush

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">

                    <div class="card card-primary card-outline">

                        <div class="card-header">
                            <h3 class="card-title">Employee Details</h3>
                        </div>

                        <form id="employeeadd" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="alert alert-danger d-none" id="add-error-bag">
                                    <strong>Whoops!</strong> There were some problems with your input.
                                    <ul id="add-task-errors">
                                    </ul>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="inputEmpNo">Employee Number</label>
                                            <input type="number" minlength="10" maxlength="10" class="form-control" name="EmployeeNumber" placeholder="Enter employee number..">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="inputLastName">Last Name</label>
                                            <input type="text" class="form-control" name="LastName" placeholder="Enter last name..">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="inputFirstName">First Name</label>
                                            <input type="text" class="form-control" name="FirstName" placeholder="Enter first name..">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="inputMiddleName">Middle Name</label>
                                            <input type="text" class="form-control" name="MiddleName" placeholder="Enter middle name..">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="inputMiddleName">Nickname</label>
                                            <input type="text" class="form-control" name="Nickname" placeholder="Enter nickname..">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Birthdate</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                                </div>
                                                <input type="text" name="BirthDate" class="form-control" data-inputmask-alias="datetime" id="bDate" data-inputmask-inputformat="yyyy/mm/dd" data-mask>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <!-- <label for="customFile">Custom File</label> -->
                                            <label for="exampleInputFile">Image Upload</label>
                                            <div class="custom-file text-break">
                                                <input type="file" accept="image/*" class="custom-file-input text-break" id="ImageUpload" name="ImageUpload">
                                                <label class="custom-file-label text-break" for="customFile">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="Email" placeholder="Enter email..">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="text" class="form-control" name="Password" placeholder="Enter password.." value="{{ substr(sha1(time()), 0, 10) }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer mb-n3">
                                <button type="submit" class="btn btn-primary" id="btn-submit">Add Employee</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
@endsection

@push('addons')
    <script src="{{asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            bsCustomFileInput.init();
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#employeeadd').on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route('employee.store') }}',
                type: 'POST',
                data:  new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    $("#add-error-bag").addClass('d-none');
                    $('#add-task-errors').empty();
                    alert(data.message);
                    location.href = '/employee';
                },
                error : function (response) {
                    var errors = $.parseJSON(response.responseText);
                    $('#add-task-errors').empty();
                    $.each(errors.messages, function(key, value) {
                        $('#add-task-errors').append('<li>' + value + '</li>');
                    });
                    $("#add-error-bag").removeClass('d-none');
                }
            });
        });

        $('#bDate').daterangepicker({
            singleDatePicker: true,
            locale: {
                format: 'YYYY/MM/DD'
            }
        });

    </script>
    <script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
    <script src="{{asset('plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('plugins/inputmask/min/jquery.inputmask.bundle.min.js')}}"></script>
    <script>
        $('.select2').select2();
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });
        //Datemask yyyy/mm/dd
        $('#datemask').inputmask('yyyy/mm/dd', { 'placeholder': 'yyyy/mm/dd' });
        //Datemask2 yyyy/mm/dd
        $('#datemask2').inputmask('yyyy/mm/dd', { 'placeholder': 'yyyy/mm/dd' });
        //Money Euro
        $('[data-mask]').inputmask()
    </script>
@endpush

