<!-- Breadcumb -->
<div class="row">

    <div class="col">
        <nav aria-label="breadcrumb ">
            <ol class="breadcrumb bg-transparent">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= ucfirst($page) ?> produk</li>
            </ol>
        </nav>
    </div>

    <div class="col">
        <a href="<?= site_url() ?>produk" class="btn btn-warning btn-icon-split float-right">
            <span class="icon text-white-50">
                <i class="fas fa-undo"></i>
            </span>
            <span class="text">Kembali</span>
        </a>
    </div>
</div>

<div class="row">
    <div class="container-fluid">
        <div class="card p-2">
            <div class="card-header text-center">
                <?= ucfirst($page) ?> data
            </div>
            <div class="card-body">
                <div class="col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-6 offset-xl-3">
                    <!-- form -->
                    <form method="post" action="<?= site_url('produk/process') ?>">
                        <!-- form hidden -->
                        <input type="hidden" name="produk_id" id="produk_id" value="<?= $row->produk_id != '' ? $row->produk_id : 'cdt' . date('ymd') . random_string('alnum', 21)  ?>">
                        <div class="form-group">
                            <label for="nama_produk">Nama barang*</label>
                            <input type="text" class="form-control" name="nama_produk" id="nama_produk" value="<?= $row->nama_produk ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="harga">harga barang*</label>
                            <input type="number" class="form-control" name="harga" id="harga" value="<?= $row->harga ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="komisi">komisi barang*</label>
                            <input type="number" class="form-control" name="komisi" id="komisi" value="<?= $row->komisi ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="hrg_vendor">hrg_vendor barang*</label>
                            <input type="number" class="form-control" name="hrg_vendor" id="hrg_vendor" value="<?= $row->harga_vendor ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="stock">stock barang*</label>
                            <input type="number" class="form-control" name="stock" id="stock" value="<?= $row->stock ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="level">level barang*</label>
                            <input type="number" class="form-control" name="level" id="level" value="<?= $row->level ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="desk">desk barang</label>
                            <textarea class="form-control" name="desk" id="desk"><?= $row->desk ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="gambar">Url Gambar barang</label>
                            <input type="text" class="form-control" name="gambar" id="gambar" placeholder="https://website.com/gambaxxx..." value="<?= $row->gambar ?>">
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="submit" class="btn btn-primary btn-block " name="<?= $page ?>" value="Kirim" ">
                                    </div>
    
                                    <div class=" col">
                                <input type="reset" class="btn btn-warning btn-block" name="reset" value="Reset" ">
                                    </div>
                                </div>
                                <hr />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>