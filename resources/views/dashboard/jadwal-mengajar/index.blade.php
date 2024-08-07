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
          <h1>Daftar Jadwal Mengajar Dosen</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item active">Jadwal Mengajar Dosen</li>
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
            <a href="{{url('/jadwal/jadwal-mengajar/create')}}" class="btn btn-success">
                <i class="fas fa-plus"></i>
                Tambah Data
            </a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
            <div class="card">
                <div class="card-header">
                <h3 class="card-title">Daftar data Jadwal Mengajar Dosen</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Mata Kuliah</th>
                                <th>Ruangan</th>
                                <th>Dosen</th>
                                <th>Detail</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $key => $item)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$item['matkul']}}</td>
                                <td>{{$item['ruangan']}}</td>
                                <td>{{$item['dosen']}}</td>
                                <td>
                                    <b>Hari : </b> {{$item['hari']}}
                                    <br>
                                    @foreach($item['jam'] as $index => $jam)
                                        <b>Jam ke- {{$index + 1}} : </b> {{ $jam['jam_mulai'] }} - {{ $jam['jam_selesai'] }}<br>
                                    @endforeach
                                </td>
                                {{-- <td>{{ \Carbon\Carbon::make($item->created_at)->format('d F Y H:i:s') }}</td> --}}
                                <td>
                                    {{-- <a class="btn btn-primary btn-sm" href="{{url('/kategori/edit/'.$item->id)}}">
                                        <i class="fas fa-pencil-alt"></i> Edit
                                    </a> 
                                    &nbsp;
                                    <a class="btn btn-primary btn-sm" href="{{url('/arsip-surat/show/'.$item->id)}}">
                                        <i class="fas fa-eye"></i> Lihat
                                    </a>
                                    &nbsp;
                                    <a class="btn btn-warning btn-sm" href="{{url('/arsip-surat/download/'.$item->id)}}">
                                        <i class="fas fa-download"></i> Download
                                    </a>
                                    &nbsp; --}}
                                    <a class="btn btn-danger btn-sm ondelete" href="{{url('/jadwal/jadwal-mengajar/delete/'.$item['id'])}}"> 
                                        <i class="fas fa-trash"></i> Delete
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
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