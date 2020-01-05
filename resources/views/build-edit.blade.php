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
                            <h3 class="card-title">Build Details</h3>
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
                        <form id="buildupdate" method="POST" action="{{route('build.update',['id'=>$build->build_id])}}">
                            @method('PUT')
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Projects</label>
                                            <select class="form-control select2bs4" style="width: 100%;" name="inputProject">
                                                <option selected="selected" disabled="disabled" value="null"></option>
                                                @foreach($projects as $project)
                                                    @if($project->proj_id==$build->proj_id)
                                                        <option value="{{ $project->proj_id }}" selected="selected">{{ $project->proj_name }}</option>
                                                    @else
                                                        <option value="{{ $project->proj_id }}" >{{ $project->proj_name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="inputSP">Service Pack</label>
                                            <input type="text" class="form-control" name="inputSP" placeholder="Enter SP.." value="{{$build->sp_id}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="inputVS">Version</label>
                                            <input type="text" class="form-control" name="inputVS" placeholder="Enter Version.." value="{{$build->version_id}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="inputDrop">Drop</label>
                                            <input type="text" class="form-control" name="inputDrop" placeholder="Enter Drop.." value="{{$build->drop_id}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="inputDescr">Description</label>
                                            <input type="text" class="form-control" name="inputDescr" placeholder="Enter Description.." value="{{$build->descr}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary" id="btn-submit">Update Build</button>
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
        {{--$.ajaxSetup({--}}
        {{--    headers: {--}}
        {{--        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
        {{--    }--}}
        {{--});--}}
        {{--$('#btn-submit').click(function (e) {--}}
        {{--    e.preventDefault();--}}
        {{--    $(this).html('Adding..');--}}
        {{--    $.ajax({--}}
        {{--        data: $('#buildadd').serialize(),--}}
        {{--        url: "{{ route('build.store') }}",--}}
        {{--        type: "POST",--}}
        {{--        dataType: 'json',--}}
        {{--        success: function (data) {--}}
        {{--            console.log(data);--}}
        {{--        },--}}
        {{--        error: function (data) {--}}
        {{--            console.log('Error:', data);--}}
        {{--        }--}}
        {{--    });--}}
        {{--});--}}

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

