<div class="modal fade" id="modal-edit-{{$item->id}}">
    <div class="modal-dialog modal-lg">
        <form action="{{url('/user/update/'.$item->id)}}" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Data User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="role" class="col-sm-4 col-form-label">Role</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="role" name="role" required>
                                        <option value="">-- Pilih Role --</option>
                                        <option value="admin" {{$item->role == 'admin' ? 'selected' : ''}}>Admin</option>
                                        <option value="dosen" {{$item->role == 'dosen' ? 'selected' : ''}}>Dosen</option>
                                        <option value="mahasiswa" {{$item->role == 'mahasiswa' ? 'selected' : ''}}>Mahasiswa</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="nama" class="col-sm-4 col-form-label">Nama</label>
                                <div class="col-sm-8 d-flex">
                                    <input type="text" class="form-control" id="nama" name="nama" value="{{$item->name}}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="nomor" class="col-sm-4 col-form-label">Nomor</label>
                                <div class="col-sm-8 d-flex">
                                    <input type="text" class="form-control" id="nomor" name="nomor" value="{{$item->nomor}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label">Email</label>
                                <div class="col-sm-8 d-flex">
                                    <input type="text" class="form-control" id="email" name="email" value="{{$item->email}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="uid" class="col-sm-4 col-form-label">UID</label>
                                <div class="col-sm-8 d-flex">
                                    <input type="text" class="form-control" id="uid" name="uid" value="{{$item->uid}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="username" class="col-sm-4 col-form-label">Username</label>
                                <div class="col-sm-8 d-flex">
                                    <input type="text" class="form-control" id="username" name="username" value="{{$item->username}}" required>
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