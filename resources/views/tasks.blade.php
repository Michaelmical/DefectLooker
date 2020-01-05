@extends('layouts.admin');

@push('ui')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@endpush

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Overall Tasks</h3>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Build</th>
                                    <th>Task</th>
                                    <th>Incident Type</th>
                                    <th>Severity</th>
                                    <th width="120px">Date Started</th>
                                    <th width="120px">Date Completed</th>
                                    <th width="80px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($aTaskData as $aData)
                                <tr data-id="{{ $aData->task_id }}">
                                    <td>{{ $aData->descr }}</td>
                                    <td>{{ $aData->task_id }}</td>
                                    <td>{{ ucfirst($aData->inc_type) }}</td>
                                    <td>{{ ucfirst($aData->severity) }}</td>
                                    <td>{{ ucfirst($aData->started_at) }}</td>
                                    <td>{{ ucfirst($aData->completed_at) }}</td>
                                    <td>
                                        <a class="btn btn-warning" href="tasks/{{ $aData->task_id }}/edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a class="btn btn-danger btnTaskDelete">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Build</th>
                                    <th>Task</th>
                                    <th>Incident Type</th>
                                    <th>Severity</th>
                                    <th>Date Started</th>
                                    <th>Date Completed</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('addons')
    <script src="{{asset('plugins/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
    <script>
        $(function () {
            $("#example1").DataTable();
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
            });
        });
    </script>
@endpush
