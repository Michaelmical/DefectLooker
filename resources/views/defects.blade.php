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
                        <h3 class="card-title">List of Task with Defects</h3>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Task ID</th>
                                <th>Description</th>
                                <th>Total # of Defects</th>
                                <th>Allowable Defects</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tasks as $task)
                                <tr>
                                    <td>{{$task->taskid}}</td>
                                    <td>{{$task->descr}}</td>
                                    <td>{{$task->points}}</td>
                                    <td>{{$task->allowable}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Task ID</th>
                                <th>Description</th>
                                <th>Total # of Defects</th>
                                <th>Allowable Defects</th>
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

    </script>
@endpush

