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
          <h1>Daftar Absensi</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item active">Absensi</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
        <div class="row">
            <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title">Daftar Data Absensi - 
                            <b>{{$hariIni}}</b>
                        </h3>
                        <form action="{{url('/dosen-absen')}}" method="GET" class="form-inline">
                            <div class="form-group mb-0">
                                <label for="tanggal" class="mr-2">Cari Berdasarkan Tanggal</label>
                                <input type="date" class="form-control" name="tanggal" id="tanggal" value="{{$request->tanggal}}">
                            </div>
                            <button class="btn btn-success ml-2" type="submit"><i class="fas fa-search"></i> Filter</button>
                            <a href="{{url('/dosen-absen')}}" class="btn btn-secondary ml-2"><i class="fas fa-sync"></i> Reset</a>
                        </form>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Hari</th>
                                <th>Mata Kuliah</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach($data as $key => $value)
                                    <td>{{$key+1}}</td>
                                    <td>{{$value->hari}}, {{ \Carbon\Carbon::parse($value->created_at)->isoFormat('DD MMMM YYYY') }}</td>
                                    <td>{{$value->mata_kuliah}} ({{$value->kode}} / {{$value->tahun}}) </td>
                                    <td>
                                        <b>Status : </b> @empty($value->status) - @else {{$value->status}} @endempty
                                        <br>
                                        <b>Jam Masuk : </b> @if($value->jam_masuk == null) - @else {{ \Carbon\Carbon::parse($value->jam_masuk)->format('H:i:s')}} @endif
                                        <br>
                                        <b>Jam Keluar : </b> @if($value->jam_keluar == null) - @else {{ \Carbon\Carbon::parse($value->jam_keluar)->format('H:i:s')}} @endif
                                    </td>
                                @endforeach
                            </tr>
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