@extends('layouts.admin');

@push('ui')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Create Task</h3>
                    </div>
                    <form role="form">

                        <div class="card-body">
                            <form role="form">
                                <div class="row">
                                    <div class="col-md-3">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Project</label>
                                            <select class="form-control select2bs4" style="width: 100%;">
                                                <option selected="selected" disabled="disabled" value="null"></option>
                                                <option>Alaska</option>
                                                <option>California</option>
                                                <option>Delaware</option>
                                                <option>Tennessee</option>
                                                <option>Texas</option>
                                                <option>Washington</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Reference ID</label>
                                            <input type="text" class="form-control" placeholder="e.g (RID-000001)">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Incident Type</label>
                                            <select class="form-control select2bs4">
                                                <option value="null" selected disabled></option>
                                                <option value="test">{{ ucfirst('test') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Severity</label>
                                            <select class="form-control select2bs4">
                                                <option value="null" selected disabled></option>
                                                <option value="low">{{ ucfirst('low') }}</option>
                                                <option value="test">{{ ucfirst('medium') }}</option>
                                                <option value="test">{{ ucfirst('high') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Text Disabled</label>
                                            <input type="text" class="form-control" placeholder="Enter ...">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <!-- textarea -->
                                        <div class="form-group">
                                            <label>Textarea</label>
                                            <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Textarea Disabled</label>
                                            <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('addons')
    <script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
    <script>
        $('.select2').select2();
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });
    </script>
@endpush
