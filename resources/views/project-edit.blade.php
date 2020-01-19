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
                    <h1>Projects</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('project')}}">Project</a></li>
                        <li class="breadcrumb-item active">Edit</li>
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
                            <h3 class="card-title">Project Details</h3>
                        </div>
                        <!-- /.card-header -->

                        <div class="alert alert-danger" id="add-error-bag" style="display: none">
                            <strong>Whoops!</strong> There were some problems with your input.
                            <ul id="add-task-errors">
                            </ul>
                        </div>
                        <!-- form start -->
{{--                        <form id="projectUpdate" method="POST" action="{{route('project.update',['id'=>$project->proj_id])}}">--}}
                        <form id="projectUpdate">
                            @method('PUT')
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="inputSP">Project Name</label>
                                            <input type="text" class="form-control" name="inputProjectName" placeholder="Enter Project Name.." value="{{$project->proj_name}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <input id="projid" name="projid" type="hidden" value="{{$project->proj_id}}">
                                <button class="btn btn-primary" id="btn-submit">Update Project</button>
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
    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#btn-submit").click(function(e){
            e.preventDefault();

            var data = $("#projectUpdate").serialize();
            var projId = $('input[name=projid]').val();

            $.ajax({
                type:'POST',
                url:'/project/' + projId,
                data:data,
                success: function(data) {
                    window.location.href ='{{url('project')}}';
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

