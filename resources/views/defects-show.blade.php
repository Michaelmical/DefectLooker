@extends('layouts.admin')

@push('ui')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
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
                    <h1>Defects</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('defects')}}">Defects</a></li>
                        <li class="breadcrumb-item active">View</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Associated items for {{$origtaskid}}</h3>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Task ID</th>
                                <th>Description</th>
                                <th>Defect Type</th>
                                <th>Defect Cause</th>
                                <th>Area Found</th>
                                <th>Remarks</th>
                                <th>Create Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tasks as $task)
                                <tr>
                                    <td>{{$task->taskid}}</td>
                                    <td>{{$task->descr}}</td>
                                    <td>{{$task->defecttypedescr}}</td>
                                    <td>{{$task->defectcausedescr}}</td>
                                    <td>{{$task->area}}</td>
                                    <td>{{$task->remarks}}</td>
                                    <td>{{$task->created_at}}</td>
{{--                                    <td>--}}
{{--                                        <a class="btn btn-info btn-sm" href="{{route('defects-show',['id'=>$task->taskid])}}">--}}
{{--                                            <i class="fas fa-eye"></i> View--}}
{{--                                        </a>--}}
{{--                                    </td>--}}
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Task ID</th>
                                <th>Description</th>
                                <th>Defect Type</th>
                                <th>Defect Cause</th>
                                <th>Area Found</th>
                                <th>Remarks</th>
                                <th>Create Date</th>
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

