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
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Defects</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('defects')}}">Defects</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Defects Details</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="alert alert-danger" id="add-error-bag" style="display: none">
                            <strong>Whoops!</strong> There were some problems with your input.
                            <ul id="add-task-errors">
                            </ul>
                        </div>
                        <!-- form start -->
                        <form id="defectsadd">
{{--                            <form id="defectsadd" method="POST" action="{{route('defects.store')}}">--}}
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Project</label>
                                            <select class="form-control select2bs4 btnProjectId" style="width: 100%;" name="inputProjectId">
                                                <option></option>
                                                @foreach($projectlist as $project)
                                                    <option value="{{ $project->proj_id }}">{{ $project->proj_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Bug ID #</label>
                                            <select class="form-control select2bs4 btnBuildId" disabled style="width: 100%;" name="inputBuildId">
                                                <option></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Orig Ref #</label>
                                            <select class="form-control select2bs4 btnOrigRefNo" disabled required style="width: 100%;" name="inputOrigRefNo">
                                                <option></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Defect Type</label>
                                            <select class="form-control select2bs4 btnDefectType" style="width: 100%;" name="inputDefectType">
                                                <option selected="selected" disabled="disabled" value="null"></option>
                                                @foreach($defecttypelist as $defecttype)
                                                    <option value="{{ $defecttype->defect_type_id }}">{{ $defecttype->desc_type }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Defect Cause</label>
                                            <select class="form-control select2bs4 btnDefectCause" style="width: 100%;" name="inputDefectCause">
                                                <option selected="selected" disabled="disabled" value="null"></option>
                                                @foreach($defectcauselist as $defectcause)
                                                    <option value="{{ $defectcause->defect_cause_id}}">{{ $defectcause->desc_cause }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="inputAreaCategory">Area/Category found</label>
                                            <input type="text" class="form-control btnAreaCategory" name="inputAreaCategory" placeholder="Enter Area or Category..">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <!-- textarea -->
                                        <div class="form-group">
                                            <label>Remarks</label>
                                            <textarea class="form-control btnRemarks" rows="3" placeholder="Enter ..." name="inputRemarks"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary" id="btn-submit">Add Defects</button>
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

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('body').on('change', '.btnProjectId', function () {
            var oThis = $(this);
            $.ajax({
                url : '/defects/' + oThis.val() +'/build' ,
                method : 'GET',
                success : function (data) {
                    //console.log(data);
                    oThis.parent().parent().next().find('select').empty();
                    oThis.parent().parent().next().find('select').append(
                        '<option></option>'
                    );
                    $.each(data, function (index, value) {
                        oThis.parent().parent().next().find('select').append(
                            '<option value="'+ value.taskid +'">'+value.taskid+'</option>'
                        );
                    });
                    oThis.parent().parent().next().find('select').removeAttr('disabled');
                }
            })
        });

        $('body').on('change', '.btnBuildId', function () {
            //alert($(this).val());
            var oThis = $(this);
            $.ajax({
                url : '/defects/' + oThis.val() +'/original',
                method : 'GET',
                success : function (data) {
                    //console.log(data);
                    oThis.parent().parent().next().find('select').empty();
                    oThis.parent().parent().next().find('select').append(
                        '<option></option>'
                    );
                    $.each(data, function (index, value) {
                        oThis.parent().parent().next().find('select').append(
                            '<option value="'+ value.taskid +'">'+value.taskid+'</option>'
                        );
                    });
                    oThis.parent().parent().next().find('select').removeAttr('disabled');
                }
            })
        });

        $("#btn-submit").click(function(e){
            e.preventDefault();
            var data = $("#defectsadd").serialize();
            $.ajax({
                type:'POST',
                url:'{{url('defects')}}',
                data:data,
                success: function(data) {
                    window.location.href ='{{url('defects')}}';
                },
                error: function(data) {
                    var errors = $.parseJSON(data.responseText);
                    $('#add-task-errors').html('');
                    $.each(errors.messages, function(key, value) {
                        $('#add-task-errors').append('<li>' + value + '</li>');
                    });
                    $("#add-error-bag").show();
                }
            });
        });

    </script>
@endpush

