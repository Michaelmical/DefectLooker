@extends('layouts.admin')

@push('ui')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@endpush

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">BUILDS</h3>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Project Name</th>
                                <th>Build Description</th>
                                <th>Service Pack</th>
                                <th>Version</th>
                                <th>Drop</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($builds as $build)
                                <tr>
                                    <td>{{$build->proj_name}}</td>
                                    <td>{{$build->descr}}</td>
                                    <td>{{$build->sp_id}}</td>
                                    <td>{{$build->version_id}}</td>
                                    <td>{{$build->drop_id}}</td>
                                    <td>
                                        <a href="#" >EDIT</a>
                                        <a href="#">DELETE</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Project Name</th>
                                <th>Build Description</th>
                                <th>Service Pack</th>
                                <th>Version</th>
                                <th>Drop</th>
                                <th>Actions</th>
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

