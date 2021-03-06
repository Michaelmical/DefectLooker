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
        <div class="row">
            <div class="col-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Update Task</h3>
                    </div>
                    <div class="card-body">
                        <form role="form ">
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-3 {{ (session('grpid') === 1) ? '' : 'd-none' }}">
                                    <div class="form-group">
                                        <label>Employee</label>
                                        <select class="form-control select2bs4" style="width: 100%;" id="optEmployee">
                                            <option selected="selected" disabled="disabled" value="null"></option>
                                            @foreach($aEmpData as $aEData)
                                                @if($aEData->active === 'active')
                                                    <option selected value="{{ $aEData->emp_id }}">[{{ $aEData->emp_number }}] - {{ $aEData->last_name }}, {{ $aEData->first_name }} {{ $aEData->middle_name }}</option>
                                                @else
                                                    <option value="{{ $aEData->emp_id }}">[{{ $aEData->emp_number }}] - {{ $aEData->last_name }}, {{ $aEData->first_name }} {{ $aEData->middle_name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Build</label>
                                        <select class="form-control select2bs4" style="width: 100%;" id="optBuild">
                                            @foreach($aBuildData as $aData)
                                                @if($aData->active === 'active')
                                                    <option value="{{ $aData->build_id }}" selected>{{ $aData->descr }}</option>
                                                @else
                                                    <option value="{{ $aData->build_id }}">{{ $aData->descr }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Task ID</label>
                                        <input value="{{ $aTaskData->task_id }}" disabled type="text" class="form-control" placeholder="e.g (RID-000001)" id="txtTaskId">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Incident Type</label>
                                        <select class="form-control select2bs4" style="width: 100%;" id="optIncidentType">
                                            @foreach($aIncType as $aIncData)
                                                @if($aIncData['active'] === 'active')
                                                    <option value="{{ $aIncData['types'] }}" selected>{{ ucfirst($aIncData['types']) }}</option>
                                                @else
                                                    <option value="{{ $aIncData['types'] }}">{{ ucfirst($aIncData['types']) }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Severity</label>
                                        <select class="form-control select2bs4" style="width: 100%;" id="optSeverity">
                                            @foreach($aSeverity as $aSevData)
                                                @if($aSevData['active'] === 'active')
                                                    <option value="{{ $aSevData['type'] }}" selected>{{ ucfirst($aSevData['type']) }}</option>
                                                @else
                                                    <option value="{{ $aSevData['type'] }}">{{ ucfirst($aSevData['type']) }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Date Started</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                            </div>
                                            <input value="{{ $aTaskData->started_at }}" type="text" id="dtStarted" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy/mm/dd" data-mask>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Date Completed</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                            </div>
                                            <input value="{{ $aTaskData->completed_at }}" type="text" id="dtCompleted" class="form-control date-completed" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy/mm/dd" data-mask>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Task Description</label>
                                        <textarea class="form-control" rows="4" id="txtdesc">{{ $aTaskData->name }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-1">
                                    <button type="button" class="btn btn-block btn-warning" id="btn-task-update">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('addons')
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/inputmask/min/jquery.inputmask.bundle.min.js') }}"></script>
    <script src="{{ asset('customjs/task-store.js') }}"></script>

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
        $('[data-mask]').inputmask();

        $('#dtStarted').daterangepicker({
            singleDatePicker: true,
            locale: {
                format: 'YYYY/MM/DD'
            }
        });
        $('#dtCompleted').daterangepicker({
            singleDatePicker: true,
            locale: {
                format: 'YYYY/MM/DD'
            }
        });
    </script>
@endpush
