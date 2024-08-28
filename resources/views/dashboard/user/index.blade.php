@extends('layouts.app')

@section('custom-css')
<link rel="stylesheet" href="{{url('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{url('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{url('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
<!-- Select2 -->
<link rel="stylesheet" href="{{url('plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{url('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Daftar User</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item active">User</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
        <div class="row mb-2 d-flex justify-content-end mr-auto">
            <div class="ml-auto">
                <a style="cursor: pointer;" type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-create">
                    <i class="fas fa-plus"></i>
                    Tambah Data
                </a>
            </div>
            <a href="{{url('/get-api')}}" class="btn btn-primary ml-2"><i class="fas fa-sync"></i> Get API User</a>
        </div>
        <div class="row">
            <div class="col-12">
            <div class="card">
                <div class="card-header">
                <h3 class="card-title">Daftar data user</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Role</th>
                        <th>Nama</th>
                        <th>Nomor</th>
                        <th>Email</th>
                        <th>UID</th>
                        <th>Username</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    @foreach($data as $key => $item)
                    @include('dashboard.user.modal-edit')
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$item->role}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->nomor}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->uid}}</td>
                        <td>{{$item->username}}</td>
                        <td>
                            <a class="btn btn-primary btn-sm" 
                                data-toggle="modal" data-target="#modal-edit-{{$item->id}}">
                                <i class="fas fa-pencil-alt"></i> Edit
                            </a>
                            &nbsp;
                            <a class="btn btn-danger btn-sm ondelete"
                                href="{{url('/data-master/jam/delete/'.$item->id)}}"> 
                                <i class="fas fa-trash"></i>
                                Delete
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        </div>
        @include('dashboard.user.modal-create')
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection

@section('custom-js')
    <script src="{{url('plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{url('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{url('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <!-- Select2 -->
    <script src="{{url('plugins/select2/js/select2.full.min.js')}}"></script>
    <script type="text/javascript">
    $(function () {
        $('.select2').select2({
        theme: 'bootstrap4'
        })
    });
    </script>
    <script type="text/javascript">
    $(function () {
        $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        });
    });
    function optionForm(id) {
        document.getElementById(id).submit();
        return false;
    }
    </script>
@endsection