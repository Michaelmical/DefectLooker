@extends('layouts.admin');

@push('ui')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@endpush

@push('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                                    <th width="60px;">Task ID</th>
                                    <th>Assignee</th>
                                    <th>Description</th>
                                    <th>Build</th>
                                    <th>Incident Type</th>
                                    <th width="50px">Severity</th>
                                    <th width="90px">Date Started</th>
                                    <th width="120px">Date Completed</th>
                                    <th width="80px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($aTaskData as $aData)
                                <tr data-id="{{ $aData->task_id }}">
                                    <td>{{ $aData->task_id }}</td>
                                    <td>{{ $aData->last_name }}, {{ $aData->first_name }} {{ $aData->middle_name }}</td>
                                    <td>{{ $aData->name }}</td>
                                    <td>{{ $aData->descr }}</td>
                                    <td>{{ ucfirst($aData->inc_type) }}</td>
                                    <td>{{ ucfirst($aData->severity) }}</td>
                                    <td>{{ ucfirst($aData->started_at) }}</td>
                                    <td>{{ ucfirst($aData->completed_at) }}</td>
                                    <td>
                                        <a class="btn btn-warning" href="tasks/{{ $aData->task_id }}/edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a class="btn btn-danger btnTaskDelete" id="{{ $aData->task_id }}" data-toggle="modal" data-target="#modal-danger">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Task ID</th>
                                    <th>Assignee</th>
                                    <th>Description</th>
                                    <th>Build</th>
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

    <div class="modal fade" id="modal-danger">
        <div class="modal-dialog">
            <div class="modal-content bg-danger">
                <div class="modal-header">
                    <h4 class="modal-title">Confirmation</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this record?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal" id="btnCloseTask">Cancel</button>
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-outline-light" id="btnTaskDelete2">Delete</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('addons')
    <script src="{{asset('plugins/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('body').on('click', '.btnTaskDelete', function () {
            $('#btnTaskDelete2').attr('data-id', $(this).attr("id"));
        });

        $('#btnTaskDelete2').click(function () {
            $.ajax({
                type: "DELETE",
                url: '/tasks/' + $(this).attr('data-id'),
                beforeSend:function(){
                    $('#btnTaskDelete2').text('Deleting...');
                },
                success: function (data) {
                    $('#btnCloseTask').click();
                    alert('Task Successfully Deleted.');
                    location.reload();
                },
                error: function (data) {
                    alert('Some went wrong.');
                    location.reload();
                }
            });
        });

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
