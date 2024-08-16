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
                <li class="breadcrumb-item active">Edit Data Jadwal Mahasiswa</li>
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
                                <h3 class="card-title">Edit Data Jadwal Mahasiswa</h3>
                            </div>
                            <form action="{{ url('/jadwal/jadwal-mahasiswa/update', $data->id) }}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <input type="hidden" name="mahasiswa" value="{{$data->mahasiswa_id}}">
                                    <input type="hidden" name="id" value="{{$data->id}}">
                                    <div class="form-group row">
                                        <label for="mahasiswa" class="col-sm-2 col-form-label">Mahasiswa<span class="text-danger">*</span></label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" value="{{ $data->mahasiswa }} - ({{ $data->nim }})" readonly>
                                        </div>
                                    </div>
                                    <div id="schedule">
                                        @foreach($data->jadwal as $hari => $jadwalItems)
                                            @foreach($jadwalItems as $jadwal_mengajar_id => $jadwal)
                                                <div class="schedule" id="schedule-{{ $loop->parent->index + 1 }}">
                                                    <input type="hidden" id="jadwal_mengajar_id" name="jadwal_mengajar_id[]" value="{{ $jadwal_mengajar_id }}">
                                                    <hr>
                                                    <div class="schedule-header" align="center">
                                                        @if($loop->parent->first && $loop->first)
                                                            <!-- Tidak ada tombol hapus untuk jadwal pertama -->
                                                        @else
                                                            <button type="button" class="btn btn-danger" onclick="removeScheduleOne('schedule-{{ $loop->parent->index + 1 }}')">
                                                                <i class="fas fa-minus"></i> &nbsp; Hapus matkul
                                                            </button>
                                                        @endif
                                                    </div>
                                                    <hr>
                                                    <div class="mt-3">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="hari">Hari<span class="text-danger">*</span></label>
                                                                    <select class="form-control select2 hari-select" name="hari[]" required>
                                                                        <option selected disabled>Pilih Hari</option>
                                                                        <option value="Senin" {{ $hari == 'Senin' ? 'selected' : '' }}>Senin</option>
                                                                        <option value="Selasa" {{ $hari == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                                                                        <option value="Rabu" {{ $hari == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                                                                        <option value="Kamis" {{ $hari == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                                                                        <option value="Jumat" {{ $hari == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                                                                        <option value="Sabtu" {{ $hari == 'Sabtu' ? 'selected' : '' }}>Sabtu</option>
                                                                        <option value="Minggu" {{ $hari == 'Minggu' ? 'selected' : '' }}>Minggu</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="matkul">Mata Kuliah<span class="text-danger">*</span></label>
                                                                    <select class="form-control select2 matkul-select" name="matkul[]" required>
                                                                        <option selected disabled>Pilih Mata Kuliah</option>
                                                                        <option value="{{ $jadwal['matkul'] }}" selected>{{ $jadwal['matkul'] }}</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="tahun">Tahun<span class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control tahun-input" name="tahun[]" value="{{ $jadwal['tahun'] }}" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="dosen">Dosen<span class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control dosen-input" name="dosen[]" value="{{ $jadwal['dosen'] }}" readonly>
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
                                                                        <tr>
                                                                            <td>{{ $jadwal['jam']['jam_nama'] }}</td>
                                                                            <td>{{ $jadwal['jam']['jam_mulai'] }}</td>
                                                                            <td>{{ $jadwal['jam']['jam_selesai'] }}</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endforeach
                                    </div>
                                    <div class="card-footer" align="right">
                                        <button type="button" class="btn btn-success" id="addSchecule" onclick="addScheculeOne()"> 
                                            <i class="fas fa-plus"></i> &nbsp; Tambah matkul
                                        </button>
                                        &nbsp;&nbsp;
                                        <a href="{{ url('/jadwal/jadwal-mahasiswa') }}" class="btn btn-warning">Kembali</a>
                                        &nbsp;&nbsp;
                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
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
    <script>
        var scheduleCount = {{ count($data->jadwal) }};
    
        function removeScheduleOne($id) {
            $('#' + $id).remove();
            scheduleCount--;
        }
    
        function addScheculeOne() {
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
    
                $.ajax({
                    url: '/get-jadwal',
                    type: 'POST',
                    data: {
                        hari: hari,
                        _token: '{{ csrf_token() }}'
                    },
                    cache: false,
                    success: function(response) {
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

            // Initialize event handlers for the existing schedules
            for (var i = 1; i <= scheduleCount; i++) {
                initializeScheduleHandlers(`#schedule-${i}`);
            }
        });
    </script>
@endsection
