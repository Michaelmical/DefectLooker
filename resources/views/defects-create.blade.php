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
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Defects Details</h3>
                        </div>
                        <!-- /.card-header -->

                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <!-- form start -->
                        <form id="defectsadd" method="POST" action="{{route('defects.store')}}">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Bug ID #</label>
                                            <select class="form-control select2bs4" style="width: 100%;" name="bugid">
                                                <option selected="selected" disabled="disabled" value="null"></option>
                                                @foreach($tasklist as $task)
                                                    <option value="{{ $task->task_id }}">{{ $task->task_id }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Orig Ref #</label>
                                            <select class="form-control select2bs4" style="width: 100%;" name="origrefno">
                                                <option selected="selected" disabled="disabled" value="null"></option>
                                                @foreach($tasklist as $task)
                                                    <option value="{{ $task->task_id }}">{{ $task->task_id }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Defect Type</label>
                                            <select class="form-control select2bs4" style="width: 100%;" name="defecttype">
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
                                            <select class="form-control select2bs4" style="width: 100%;" name="defectcause">
                                                <option selected="selected" disabled="disabled" value="null"></option>
                                                @foreach($defectcauselist as $defectcause)
                                                    <option value="{{ $defectcause->defect_cause_id}}">{{ $defectcause->desc_cause }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="areacategory">Area/Category found</label>
                                            <input type="text" class="form-control" name="areacategory" placeholder="Enter Area or Category..">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <!-- textarea -->
                                        <div class="form-group">
                                            <label>Remarks</label>
                                            <textarea class="form-control" rows="3" placeholder="Enter ..." name="remarks"></textarea>
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
        //Datemask yyyy/mm/dd
        $('#datemask').inputmask('yyyy/mm/dd', { 'placeholder': 'yyyy/mm/dd' });
        //Datemask2 yyyy/mm/dd
        $('#datemask2').inputmask('yyyy/mm/dd', { 'placeholder': 'yyyy/mm/dd' });
        //Money Euro
        $('[data-mask]').inputmask()
    </script>
@endpush

