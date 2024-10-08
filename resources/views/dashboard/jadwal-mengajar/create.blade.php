@extends('layouts.app')

@section('custom-css')
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
                <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                <li class="breadcrumb-item active">Tambah Data Jadwal Mengajar</li>
                </ol>
            </div>
            </div>
        </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Tambah Data Jadwal Mengajar</h3>
                            </div>
                            <form action="{{ url('/jadwal/jadwal-mengajar/store') }}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="dosen" class="col-sm-2 col-form-label">Dosen<span class="text-danger">*</span></label>
                                        <div class="col-sm-10">
                                            <select class="form-control select2" name="dosen" required>
                                                <option selected disabled>Pilih Dosen</option>
                                                @foreach($dosen as $k)
                                                    <option value="{{ $k->id }}">{{ $k->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="matkul" class="col-sm-2 col-form-label">Mata Kuliah<span class="text-danger">*</span></label>
                                        <div class="col-sm-10">
                                            <select class="form-control select2" name="matkul" required>
                                                <option selected disabled>Pilih Mata Kuliah</option>
                                                @foreach($matkul as $k)
                                                    <option value="{{ $k->id }}">{{ $k->nama }} ({{ $k->kode }}) - {{ $k->tahun }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>                                    
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Jadwal<span class="text-danger">*</span></label>
                                        <div class="col-sm-10">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label for="hari" class="col-form-label">Hari</label>
                                                    <select class="form-control select2" name="hari" required>
                                                        <option selected disabled>Pilih Hari</option>
                                                        <option value="Senin">Senin</option>
                                                        <option value="Selasa">Selasa</option>
                                                        <option value="Rabu">Rabu</option>
                                                        <option value="Kamis">Kamis</option>
                                                        <option value="Jumat">Jumat</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="jam" class="col-form-label">Jam</label>
                                                    <select class="form-control select2" name="jam[]" required>
                                                        <option selected disabled>Pilih Jam Mulai</option>
                                                        @foreach($jam as $k)
                                                            <option value="{{ $k->id }}">{{ $k->nama }} ({{ $k->jam_mulai }} - {{ $k->jam_selesai }})</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div id="additional-schedules"></div>
                                        </div>
                                        <div class="product-header" align="center">
                                            <button type="button" class="btn btn-success" id="addSchedule"> 
                                                <i class="fas fa-plus"></i> &nbsp; Tambah Jam
                                            </button>
                                        </div>
                                    </div>
                                <div class="card-footer" align="right">
                                    <a href="{{ url('/jadwal/jadwal-mengajar') }}" class="btn btn-warning">Kembali</a>
                                    &nbsp;&nbsp;
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('custom-js')
<script>
    var scheduleCount = 1;

    function addSchedule() {
        scheduleCount++;
        var scheduleDiv = `
            <div class="row mt-3" id="schedule-${scheduleCount}">
                <div class="col-sm-6">
                    
                </div>
                <div class="col-sm-6">
                    <label for="jam" class="col-form-label">Jam Ke-${scheduleCount}</label>
                    <select class="form-control select2" name="jam[]" required>
                        <option selected disabled>Pilih Jam Mulai</option>
                        @foreach($jam as $k)
                            <option value="{{ $k->id }}">{{ $k->nama }} ({{ $k->jam_mulai }} - {{ $k->jam_selesai }})</option>
                        @endforeach
                    </select>
                    <button type="button" class="btn btn-danger mt-2" onclick="removeSchedule(${scheduleCount})">
                        <i class="fas fa-minus"></i> Hapus
                    </button>
                </div>
            </div>`;
        document.getElementById('additional-schedules').insertAdjacentHTML('beforeend', scheduleDiv);
        $('.select2').select2({
            theme: 'bootstrap4'
        });
        renumberSchedules();
    }

    function removeSchedule(id) {
        document.getElementById(`schedule-${id}`).remove();
        renumberSchedules();
    }

    function renumberSchedules() {
        const schedules = document.querySelectorAll('#additional-schedules .row');
        schedules.forEach((schedule, index) => {
            const newIndex = index + 2; // Mulai dari 2 karena jam pertama bukan hasil cloning
            schedule.id = `schedule-${newIndex}`;
            schedule.querySelector('label').textContent = `Jam Ke-${newIndex}`;
            schedule.querySelector('.btn-danger').setAttribute('onclick', `removeSchedule(${newIndex})`);
        });
        scheduleCount = schedules.length + 1;
    }

    document.getElementById('addSchedule').addEventListener('click', addSchedule);
</script>
@endsection

