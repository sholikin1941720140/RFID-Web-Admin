<div class="modal fade" id="modal-edit-{{$item->id}}">
    <div class="modal-dialog modal-lg">
        <form action="{{url('/data-master/jam/update/'.$item->id)}}" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Data Jam</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="nama" class="col-sm-4 col-form-label">Nama Jam</label>
                                <div class="col-sm-8">
                                    <input type="text" placeholder="Masukkan Nama Jam" class="form-control" id="nama" name="nama" value="{{$item->nama}}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="jam" class="col-sm-4 col-form-label">Jam Mulai s/d Selesai</label>
                                <div class="col-sm-8 d-flex">
                                    <input type="time" class="form-control mr-2" id="jam_mulai" name="jam_mulai" value="{{$item->jam_mulai}}" required>
                                    <span class="align-self-center"> - </span>
                                    <input type="time" class="form-control ml-2" id="jam_selesai" name="jam_selesai" value="{{$item->jam_selesai}}" required>
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