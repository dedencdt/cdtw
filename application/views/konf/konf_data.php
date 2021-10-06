<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-6">
            <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#exampleModal">
                Tambah akun Bank
            </button>
            <br>
            <div class="card shadow mb-4">

                <div class="card-header py-3">
                    <div class="col-8">
                        <h6 class="m-0 font-weight-bold text-primary">Data User</h6>
                    </div>
                    <div class="col-4 float-lg-right">
                        <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#exampleModal">
                            Tambah akun Bank
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th>Level</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>admin</td>
                                    <td>Admin</td>
                                    <td><a class="btn btn-danger" href="pengaturan.php?act=hapus&id=1">Hapus</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-md-6">
            <div class="card shadow mb-4">

                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Pengaturan</h6>
                </div>
                <div class="card-body">
                    <h4> Whatsapp Gateway : <span id="status"></span> </h4>
                    <h4><span id="qr"></span> </h4>
                    <a class="btn btn-danger btn-block" target="_blank" href="https://wa-apis2.herokuapp.com/deletesess"> Logout </a>
                    <a class="btn btn-danger btn-block" target="_blank" href="https://wa-apis2.herokuapp.com/reset"> Reset</a>
                    <br>
                    <hr>
                    <form action="" method="post">
                        <label> URL Whatsapp Gateway </label>
                        <input type="text" class="form-control" name="wa" value="https://wa-apis2.herokuapp.com">
                        <br>
                        <label> Nomor Whatsapp Yang Terkoneksi </label>
                        <input type="text" class="form-control" name="nomor" value="085157257740">
                        <br>
                        <label> Batas Pengiriman per menit </label>
                        <input type="text" class="form-control" name="chunk" value="100">
                        <br>
                        <label> API Key </label>
                        <input type="text" class="form-control" name="api_key" readonly value="af51dd67e0c003eb19476c6b1197e9022a6a7e91">
                        <br>
                        <button class="btn btn-success"> Simpan </button>
                        <a class="btn btn-primary" href="pengaturan.php?act=gapi"> Generate New API Key </a>
                    </form>
                </div>
            </div>

        </div>
    </div>


</div>
<!-- /.container-fluid -->