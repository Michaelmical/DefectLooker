@extends('layouts.admin')

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
                        <h3 class="card-title">FUNCTION POINTS</h3>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="100px;">Task No</th>
                                    <th>Task Name</th>
                                    <th class="{{ session('grpid') == 1 ? '' : 'd-none' }}">Assignee</th>
                                    <th >Total Points</th>
                                    <th >Allowable Defects</th>
                                    <th width="50px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tasks as $task)
                                    <tr>
                                        <td>{{$task->task_id}}</td>
                                        <td>{{$task->name}}</td>
                                        <td class="{{ session('grpid') == 1 ? '' : 'd-none' }}">{{$task->wholename}}</td>
                                        <td>{{$task->points}}</td>
                                        <td>{{$task->allowable}}</td>
                                        <td class="text-center text-white">
                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-breakdown" data-id="{{ $task->task_id }}" id="btnBreakDown">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Task No</th>
                                    <th>Task Name</th>
                                    <th class="{{ session('grpid') == 1 ? '' : 'd-none' }}">Assignee</th>
                                    <th>Total Points</th>
                                    <th>Allowable Defects</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="modal-breakdown">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Associated Items for: <label class="breakdown-title"></label></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                           <th>Area</th>
                                           <th>Area Type</th>
                                           <th>Associated Item</th>
                                           <th>Points</th>
                                        </tr>
                                    </thead>
                                    <tbody id="breakdown-data">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
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

        $('body').on('click', '.deleteBuild', function () {
            $('#deleteRecord').attr('data-id', $(this).attr("id"));
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#deleteRecord').click(function () {
            $.ajax({
                type: "DELETE",
                url: '/build/' + $('#deleteRecord').attr('data-id'),
                beforeSend:function(){
                    $('#deleteRecord').text('Deleting...');
                },
                success: function (data) {
                    if(data.success){
                        $('#btnCloseModal').click();
                        location.reload();
                    }
                },
                error: function (data) {
                    // console.log('Error:', data);
                }
            });
        });

        $('body').on('click', '#btnBreakDown', function () {
            var sTaskId = $(this).attr('data-id');
            $.ajax({
                type: 'POST',
                url: '/functionpoints/' + sTaskId + '/edit',
                success: function (data) {
                    $('.breakdown-title').text(data[0]['task_id']);
                    $('#breakdown-data').empty();
                    var iTotal = 0;
                    $.each(data, function (index, value) {
                        $('#breakdown-data').append(
                            '<tr>' +
                                '<td>' + value.areaname + '</td>' +
                                '<td>' + value.areatypename + '</td>' +
                                '<td>' + value.filename + '</td>' +
                                '<td>' + value.pts + '</td>' +
                            '</tr>'
                        );
                        iTotal += parseFloat(value.pts);
                    });
                    $('#breakdown-data').append(
                        '<tr>' +
                            '<td colspan="3"></td>' +
                            '<td>Total: <label class="font-weight-bold h5">' + iTotal + 'pts</label></td>' +
                        '</tr>'
                    );
                },
                error: function () {

                }
            })
        });

    </script>
@endpush

