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
                            <h3 class="card-title">Function Point Details</h3>
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
                        <form id="buildadd" method="POST" action="{{ route('functionpoints-store') }}">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Task</label>
                                            <select class="form-control select2bs4" required style="width: 100%;" name="inputProject" id="optTask">
                                                <option></option>
                                                @foreach($tasks as $task)
                                                    <option value="{{ $task->task_id }}">{{ $task->task_id }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div id="itemshere" class="mb-n4">
                                    <div class="row" id="template">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Area</label>
                                                <select class="form-control btnArea" required style="width: 100%;" name="inputArea[]">
                                                    <option></option>
                                                    @foreach($areas as $area)
                                                        <option value="{{ $area->area_id }}">{{ ucfirst($area->descr) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Area Type</label>
                                                <select class="form-control btnAreaType" disabled required style="width: 100%;" name="inputAreaType[]">
                                                    <option></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Complexity</label>
                                                <select class="form-control" disabled required style="width: 100%;" name="inputComplex[]">
                                                    <option></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="inputDescr">Associated Item</label>
                                                <input type="text" class="form-control" name="inputAssoItem[]" required placeholder="Enter Description..">
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <button type="button" class="btn btn-success btnAdd">Add</button>
                                                <button type="button" class="btn btn-danger btnRemove">Remove</button>
                                            </div>
                                        </div>
                                        <hr>
                                        <hr>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer mb-n3">
                                <button type="submit" class="btn btn-primary" id="btn-submit">Add Points</button>
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
    <script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
    <script src="{{asset('plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('plugins/inputmask/min/jquery.inputmask.bundle.min.js')}}"></script>
    <script>
        $('.select2').select2();
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });
        $('body').on('click', '.btnRemove', function () {
            var iExistPts = $('div[id="template"]').length;
            if(iExistPts === 1) {
                return false;
            }
            $(this).parent().parent().parent().remove();
        });
        $('body').on('click', '.btnAdd', function () {
            var oFuncPtsList = $('#template').clone();
            oFuncPtsList.find('input[name="inputAssoItem[]"]').val('');
            oFuncPtsList.find('select[name="inputAreaType[]"]').empty();
            oFuncPtsList.find('select[name="inputAreaType[]"]').prop('disabled', true);
            oFuncPtsList.find('select[name="inputComplex[]"]').empty();
            oFuncPtsList.find('select[name="inputComplex[]"]').prop('disabled', true);
            $('#itemshere').append(oFuncPtsList);
        });

        $('body').on('change', '.btnArea', function () {
            // alert($(this).val());
            var oThis = $(this);
            oThis.parent().parent().next().find('select').removeAttr('disabled');

            $.ajax({
                url : '/areatype/' + oThis.val(),
                method : 'GET',
                success : function (data) {
                    oThis.parent().parent().next().find('select').empty();
                    oThis.parent().parent().next().find('select').append(
                        '<option></option>'
                    );
                    $.each(data, function (index, value) {
                        oThis.parent().parent().next().find('select').append(
                            '<option value="'+ value.areatype_id +'">'+value.descr+'</option>'
                        );
                    });
                }
            })
        });

        $('body').on('change', '.btnAreaType', function () {
            var oThis = $(this);
            oThis.parent().parent().next().find('select').removeAttr('disabled');

            $.ajax({
                url : '/complex/' + oThis.val(),
                method : 'GET',
                success : function (data) {
                    oThis.parent().parent().next().find('select').empty();
                    oThis.parent().parent().next().find('select').append(
                        '<option></option>'
                    );
                    $.each(data, function (index, value) {
                        oThis.parent().parent().next().find('select').append(
                            '<option value="'+ value.complex_id +'">' + value.descr.toUpperCase() + ' - ' + value.weight.toUpperCase() + ' - ' + value.criteria + '</option>'
                        );
                    });
                }
            });
        });
    </script>
@endpush

