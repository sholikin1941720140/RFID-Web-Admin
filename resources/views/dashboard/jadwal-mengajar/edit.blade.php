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
                        <li class="breadcrumb-item active">Edit Data Jadwal Mengajar</li>
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
                            <h3 class="card-title text-center">Edit Data Jadwal Mengajar</h3>
                        </div>
                        <form action="{{ url('/jadwal/jadwal-mengajar/update/'.$data['id']) }}" method="POST">
                            @csrf
                            <input type="hidden" name="jadwal_mengajar_id" value="{{$data['id']}}">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="dosen" class="col-sm-2 col-form-label">Dosen<span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <select class="form-control select2" name="dosen" required>
                                            <option selected disabled>Pilih Dosen</option>
                                            @foreach($dosen as $k)
                                            <option value="{{ $k->id }}" {{ $data['dosen_id'] == $k->id ? 'selected' : '' }}>{{ $k->name }}</option>
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
                                            <option value="{{ $k->id }}" {{ $data['mata_kuliah_id'] == $k->id ? 'selected' : '' }}>{{ $k->nama }} ({{ $k->kode }}) - {{ $k->tahun }}</option>
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
                                                    <option value="Senin" {{ $data['hari'] == 'Senin' ? 'selected' : '' }}>Senin</option>
                                                    <option value="Selasa" {{ $data['hari'] == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                                                    <option value="Rabu" {{ $data['hari'] == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                                                    <option value="Kamis" {{ $data['hari'] == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                                                    <option value="Jumat" {{ $data['hari'] == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                                                    <option value="Sabtu" {{ $data['hari'] == 'Sabtu' ? 'selected' : '' }}>Sabtu</option>
                                                    <option value="Minggu" {{ $data['hari'] == 'Minggu' ? 'selected' : '' }}>Minggu</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="jam" class="col-form-label">Jam</label>
                                                <select class="form-control select2" name="jam[]" required>
                                                    <option selected disabled>Pilih Jam Mulai</option>
                                                    @foreach($jam as $allJam)
                                                    <option value="{{ $allJam->id }}" {{ $data['jam'][0]['jam_id'] == $allJam->id ? 'selected' : '' }}>
                                                        {{ $allJam->nama }} ({{ $allJam->jam_mulai }} - {{ $allJam->jam_selesai }})
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div id="schedule-container">
                                            @foreach($data['jam'] as $index => $existingJam)
                                            @if($index > 0)
                                            <div class="form-group row mt-3" id="schedule-{{ $index + 1 }}">
                                                <div class="col-sm-6">

                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="jam" class="col-form-label">Jam Ke-{{ $index + 1 }}</label>
                                                    <select class="form-control select2" name="jam[]" required>
                                                        <option selected disabled>Pilih Jam Mulai</option>
                                                        @foreach($jam as $allJam)
                                                        <option value="{{ $allJam->id }}" {{ $existingJam['jam_id'] == $allJam->id ? 'selected' : '' }}>
                                                            {{ $allJam->nama }} ({{ $allJam->jam_mulai }} - {{ $allJam->jam_selesai }})
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    <button type="button" class="btn btn-danger mt-2" onclick="removeSchedule({{ $index + 1 }})">
                                                        <i class="fas fa-minus"></i> Hapus
                                                    </button>                                                    
                                                </div>
                                            </div>
                                            @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mt-3">
                                    <div class="col-sm-6">
                                        <button type="button" class="btn btn-success" id="addSchedule">
                                            <i class="fas fa-plus"></i> Tambah Jam
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer" align="right">
                                <a href="{{ url('/jadwal/jadwal-mengajar') }}" class="btn btn-warning">Kembali</a>
                                &nbsp;&nbsp;
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
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
<script>
    var scheduleCount = {{ count($data['jam']) }};

    function addSchedule() {
        scheduleCount++;
        var scheduleDiv = `
            <div class="form-group row mt-3" id="schedule-${scheduleCount}">
                <div class="col-sm-6">
                    </div>
                    <div class="col-sm-6">
                    <label for="jam" class="col-form-label">Jam Ke-${scheduleCount}</label>
                    <select class="form-control select2" name="jam[]" required>
                        <option selected disabled>Pilih Jam Mulai</option>
                        @foreach($jam as $allJam)
                        <option value="{{ $allJam->id }}">{{ $allJam->nama }} ({{ $allJam->jam_mulai }} - {{ $allJam->jam_selesai }})</option>
                        @endforeach
                    </select>
                    <button type="button" class="btn btn-danger mt-2" onclick="removeSchedule(${scheduleCount})">
                        <i class="fas fa-minus"></i> Hapus
                    </button>
                </div>
            </div>`;
        document.getElementById('schedule-container').insertAdjacentHTML('beforeend', scheduleDiv);
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
        const schedules = document.querySelectorAll('#schedule-container .row');
        schedules.forEach((schedule, index) => {
            const newIndex = index + 2; // Mulai dari 2 karena jam pertama sudah diisi
            schedule.id = `schedule-${newIndex}`;
            schedule.querySelector('label').textContent = `Jam Ke-${newIndex}`;
            schedule.querySelector('.btn-danger').setAttribute('onclick', `removeSchedule(${newIndex})`);
        });
        scheduleCount = schedules.length + 1;
    }

    document.getElementById('addSchedule').addEventListener('click', addSchedule);
</script>
@endsection
