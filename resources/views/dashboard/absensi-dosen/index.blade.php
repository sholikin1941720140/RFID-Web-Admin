@extends('layouts.app')

@section('custom-css')
<!-- CSS yang dibutuhkan -->
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
                        <li class="breadcrumb-item active">Absensi Dosen</li>
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
                                <h3 class="card-title">Daftar Data Absensi Dosen - <b>{{$hariIni}}</b></h3>
                                <form action="{{url('/absensi/dosen')}}" method="GET" class="form-inline">
                                    <div class="form-group mb-0">
                                        <label for="tanggal" class="mr-2">Cari Berdasarkan Tanggal</label>
                                        <input type="date" class="form-control" name="tanggal" id="tanggal" value="{{$request->tanggal}}">
                                    </div>
                                    <button class="btn btn-success ml-2" type="submit"><i class="fas fa-search"></i> Filter</button>
                                    <a href="{{url('/absensi/dosen')}}" class="btn btn-secondary ml-2"><i class="fas fa-sync"></i> Reset</a>
                                </form>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Dosen - Mata Kuliah</th>
                                        @foreach($jam as $j)
                                            <th>{{ $j->nama }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($processedData as $dosen => $matkulGroups)
                                        @foreach($matkulGroups as $matkul => $groupedData)
                                            <tr>
                                                <td>
                                                    {{ $dosen }}<br> - <br>{{ $matkul }}
                                                </td>
                                                @foreach($jam as $j)
                                                    <td>
                                                        @php
                                                            $jamData = $groupedData->firstWhere('jam_id', $j->id);
                                                        @endphp
                                                        
                                                        @if($jamData)
                                                            @if($jamData->status == 'Hadir')
                                                                <span class="badge badge-success">Hadir</span>
                                                            @elseif($jamData->status == 'Alfa')
                                                                <span class="badge badge-danger">Alfa</span>
                                                            @else
                                                                <span class="badge badge-warning">Belum<br>Ada<br>Absensi</span>
                                                            @endif
                                                        @else
                                                            
                                                        @endif
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
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
<!-- JS yang dibutuhkan -->
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
    });

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
</script>
@endsection
