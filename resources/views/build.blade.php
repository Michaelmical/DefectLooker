@extends('layouts.admin')

@push('ui')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@endpush

@push('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
    <section class="content">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">List of Builds</h3>
            </div>

            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Project Name</th>
                        <th>Build Description</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($builds as $build)
                        <tr>
                            <td>{{$build->proj_name}}</td>
                            <td>{{$build->descr}}</td>
                            <td>
                                <a class="btn btn-info btn-sm" href="{{route('build.edit',['id'=>$build->build_id])}}">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a class="btn btn-danger btn-sm deleteBuild" data-toggle="modal" data-target="#modal-danger" id="{{$build->build_id}}">
                                    <i class="fas fa-trash"></i> Delete
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Project Name</th>
                        <th>Build Description</th>
                        <th>Actions</th>
                    </tr>
                    </tfoot>
                </table>
            </div>

            <div class="card-footer">
                <a class="btn btn-primary" href="{{route('build-create')}}">
                    <i class="fas fa-plus-square"></i> Add Build
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

