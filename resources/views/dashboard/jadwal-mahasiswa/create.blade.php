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
                <li class="breadcrumb-item active">Tambah Data Jadwal Mahasiswa</li>
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
                                <h3 class="card-title">Tambah Data Jadwal Mahasiswa</h3>
                            </div>
                            <form action="{{ url('/jadwal/jadwal-mahasiswa/store') }}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="mahasiswa" class="col-sm-2 col-form-label">Mahasiswa<span class="text-danger">*</span></label>
                                        <div class="col-sm-10">
                                            <select class="form-control select2" name="mahasiswa" required>
                                                <option selected disabled>Pilih Mahasiswa</option>
                                                @foreach($mahasiswa as $m)
                                                    <option value="{{ $m->id }}">{{ $m->name }} - ({{ $m->nomor }})</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div id="schedule">
                                        <div class="schedule" id="schedule-1">
                                            <input type="hidden" id="jadwal_mengajar_id" name="jadwal_mengajar_id[]" value="">
                                            <hr>
                                            <div class="schedule-header" align="center">
                                                <button type="button" class="btn btn-success" id="addSchecule" onclick="addScheculeOne()"> 
                                                    <i class="fas fa-plus"></i> &nbsp; Tambah matkul
                                                </button>
                                            </div>
                                            <hr>
                                            <div class="mt-3">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="hari">Hari<span class="text-danger">*</span></label>
                                                            <select class="form-control select2 hari-select" name="hari[]" required>
                                                                <option selected disabled>Pilih Hari</option>
                                                                <option value="Senin">Senin</option>
                                                                <option value="Selasa">Selasa</option>
                                                                <option value="Rabu">Rabu</option>
                                                                <option value="Kamis">Kamis</option>
                                                                <option value="Jumat">Jumat</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="matkul">Mata Kuliah<span class="text-danger">*</span></label>
                                                            <select class="form-control select2 matkul-select" name="matkul[]" required>
                                                                <option selected disabled>Pilih Mata Kuliah</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="tahun">Tahun<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control tahun-input" name="tahun[]" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="dosen">Dosen<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control dosen-input" name="dosen[]" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <label class="col-sm-2 col-form-label">Detail Jam</label>
                                                <div class="form-group row">
                                                    <div class="col-sm-10">
                                                        <table class="table table-bordered jam-table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Nama Jam</th>
                                                                    <th>Jam Mulai</th>
                                                                    <th>Jam Selesai</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <!-- Data jam akan ditampilkan di sini -->
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer" align="right">
                                        <a href="{{ url('/jadwal/jadwal-mengajar') }}" class="btn btn-warning">Kembali</a>
                                        &nbsp;&nbsp;
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
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
    {{-- <script>
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
    </script> --}}

    <script>
        var scheduleCount = 1;
    
        function removeScheduleOne($id)
        {
            $('#'+$id).remove();
            scheduleCount--;
        }
    
        function addScheculeOne()
        {
            scheduleCount++;
            var scheduleDiv = `
                <div class="schedule" id="schedule-${scheduleCount}">
                    <input type="hidden" id="jadwal_mengajar_id" name="jadwal_mengajar_id[]" value="">
                    <hr>
                    <div class="schedule-header" align="center">
                        <button type="button" class="btn btn-danger" onclick="removeScheduleOne('schedule-${scheduleCount}')">
                            <i class="fas fa-minus"></i> &nbsp; Hapus matkul
                        </button>
                    </div>
                    <hr>
                    <div class="mt-3">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="hari">Hari<span class="text-danger">*</span></label>
                                    <select class="form-control select2 hari-select" name="hari[]" required>
                                        <option selected disabled>Pilih Hari</option>
                                        <option value="Senin">Senin</option>
                                        <option value="Selasa">Selasa</option>
                                        <option value="Rabu">Rabu</option>
                                        <option value="Kamis">Kamis</option>
                                        <option value="Jumat">Jumat</option>
                                        <option value="Sabtu">Sabtu</option>
                                        <option value="Minggu">Minggu</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="matkul">Mata Kuliah<span class="text-danger">*</span></label>
                                    <select class="form-control select2 matkul-select" name="matkul[]" required>
                                        <option selected disabled>Pilih Mata Kuliah</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="tahun">Tahun<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control tahun-input" name="tahun[]" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="dosen">Dosen<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control dosen-input" name="dosen[]" readonly>
                                </div>
                            </div>
                        </div>
                        <label class="col-sm-2 col-form-label">Detail Jam</label>
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <table class="table table-bordered jam-table">
                                    <thead>
                                        <tr>
                                            <th>Nama Jam</th>
                                            <th>Jam Mulai</th>
                                            <th>Jam Selesai</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Data jam akan ditampilkan di sini -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>`;
            $('#schedule').append(scheduleDiv);
    
            // Re-initialize select2 and event listeners for the new elements
            initializeScheduleHandlers(`#schedule-${scheduleCount}`);
        }
    
        function initializeScheduleHandlers(scheduleId) {
            $(scheduleId + ' .hari-select').change(function() {
                var hari = $(this).val();
                var matkulSelect = $(scheduleId + ' .matkul-select');
                var jadwalMengajarIdInput = $(scheduleId + ' #jadwal_mengajar_id');
                console.log(hari);
    
                $.ajax({
                    url: '/get-jadwal',
                    type: 'POST',
                    data: {
                        hari: hari,
                        _token: '{{ csrf_token() }}'
                    },
                    cache: false,
    
                    success: function(response) {
                        console.log(response);
                        matkulSelect.empty();
                        matkulSelect.append('<option selected disabled>Pilih Mata Kuliah</option>');
                        
                        $.each(response, function(index, value) {
                            matkulSelect.append('<option value="'+ value.id +'" data-dosen="'+ value.dosen +'" data-tahun="'+ value.tahun +'" data-jam=\'' + JSON.stringify(value.jam) + '\'> '+ value.matkul +'</option>');
                        });
    
                        matkulSelect.change(function() {
                            var selectedOption = $(this).find('option:selected');
                            jadwalMengajarIdInput.val(selectedOption.val());
                            $(scheduleId + ' .tahun-input').val(selectedOption.data('tahun'));
                            $(scheduleId + ' .dosen-input').val(selectedOption.data('dosen'));
    
                            var jamData = selectedOption.data('jam');
                            var jamTableBody = $(scheduleId + ' .jam-table tbody');
                            jamTableBody.empty();
    
                            $.each(jamData, function(index, jamItem) {
                                $.each(jamItem, function(jamIndex, jam) {
                                    var row = '<tr>' +
                                                '<td>' + jam.nama + '</td>' +
                                                '<td>' + jam.jam_mulai + '</td>' +
                                                '<td>' + jam.jam_selesai + '</td>' +
                                            '</tr>';
                                    jamTableBody.append(row);
                                });
                            });
                        });
                    },
                });
            });
        }

        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Initialize event handlers for the first schedule
            initializeScheduleHandlers('#schedule-1');
        });
    </script>
@endsection