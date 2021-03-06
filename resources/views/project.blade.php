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
                    <h1>Projects</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Project</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
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
                        <button type="button" class="btn btn-outline-light" data-dismiss="modal" id="btnCloseModal">Cancel</button>
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-outline-light" id="deleteRecord">Delete</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </section>
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">List of Project</h3>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Project ID</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($projects as $project)
                        <tr>
                            <td>{{$project->proj_id}}</td>
                            <td>{{$project->proj_name}}</td>
                            <td>
                                <a class="btn btn-info btn-sm" href="{{route('project-show',['id'=>$project->proj_id])}}">
                                    <i class="fas fa-eye"></i> View
                                </a>
                                <a class="btn btn-warning btn-sm" href="{{route('project-edit',['id'=>$project->proj_id])}}">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a class="btn btn-danger btn-sm deleteBuild" data-toggle="modal" data-target="#modal-danger" id="{{$project->proj_id}}">
                                    <i class="fas fa-trash"></i> Delete
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Project ID</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
            <div class="card-footer">
                <a class="btn btn-success" href="{{route('project-create')}}">
                   Add Project
                </a>
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
                url: '/project/' + $('#deleteRecord').attr('data-id'),
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

