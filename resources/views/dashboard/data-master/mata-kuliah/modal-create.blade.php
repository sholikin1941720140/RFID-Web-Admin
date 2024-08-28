<div class="modal fade" id="modal-create">
    <div class="modal-dialog modal-lg">
        <form action="{{url('/data-master/matkul/store')}}" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Data Mata Kuliah</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="nama" class="col-sm-4 col-form-label">Nama Mata Kuliah</label>
                                <div class="col-sm-8">
                                    <input type="text" placeholder="Masukkan Nama Mata Kuliah" class="form-control" id="nama" name="nama" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="kode" class="col-sm-4 col-form-label">Kode</label>
                                <div class="col-sm-8 d-flex">
                                    <input type="text" placeholder="Masukkan Kode Mata Kuliah" class="form-control" id="kode" name="kode" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="tahun" class="col-sm-4 col-form-label">Tahun Semester</label>
                                <div class="col-sm-8 d-flex">
                                    <input type="text" placeholder="Masukkan Tahun Semester" class="form-control" id="tahun" name="tahun" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
        
        <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->