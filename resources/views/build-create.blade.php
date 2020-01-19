@extends('layouts.admin');

@push('ui')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
@endpush

@push('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Build</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('build')}}">Build</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Build Details</h3>
                        </div>
                        <div class="alert alert-danger" id="add-error-bag" style="display: none">
                            <strong>Whoops!</strong> There were some problems with your input.
                            <ul id="add-task-errors">
                            </ul>
                        </div>
                        <form id="buildadd">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Projects</label>
                                            <select class="form-control select2bs4" style="width: 100%;" name="inputProject">
                                                <option selected="selected" disabled="disabled" value="null"></option>
                                                @foreach($projects as $project)
                                                    <option value="{{ $project->proj_id }}">{{ $project->proj_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="inputSP">Major #</label>
                                            <input type="number" class="form-control" name="inputMajorId" placeholder="Enter SP..">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="inputVS">Minor #</label>
                                            <input type="number" class="form-control" name="inputMinorId" placeholder="Enter Version..">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="inputDrop">Drop #</label>
                                            <input type="number" class="form-control" name="inputDropId" placeholder="Enter Drop..">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="inputDescr">Description</label>
                                            <input type="text" class="form-control" name="inputDescription" placeholder="e.g (PROJECT#.#DROP#)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary" id="btn-submit">Add Build</button>
                            </div>
                        </form>
                    </div>
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
        //Datemask yyyy/mm/dd
        $('#datemask').inputmask('yyyy/mm/dd', { 'placeholder': 'yyyy/mm/dd' });
        //Datemask2 yyyy/mm/dd
        $('#datemask2').inputmask('yyyy/mm/dd', { 'placeholder': 'yyyy/mm/dd' });
        //Money Euro
        $('[data-mask]').inputmask()

        $("#btn-submit").click(function(e){
            e.preventDefault();
            var data = $("#buildadd").serialize();
            $.ajax({
                type:'POST',
                url:'{{url('build')}}',
                data:data,
                success: function(data) {
                    window.location.href ='{{url('build')}}';
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

