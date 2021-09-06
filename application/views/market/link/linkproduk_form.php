<!-- Breadcumb -->
<div class="row">

    <div class="col">
        <nav aria-label="breadcrumb ">
            <ol class="breadcrumb bg-transparent">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= ucfirst($page) ?> link produk</li>
            </ol>
        </nav>
    </div>

    <div class="col">
        <a href="<?= site_url() ?>linkproduk" class="btn btn-warning btn-icon-split float-right">
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
                    <form method="post" action="<?= site_url('linkproduk/process') ?>">
                        <!-- form hidden -->
                        <input type="hidden" name="linkproduk_id" id="linkproduk_id" value="<?= $row->linkproduk_id != '' ? $row->linkproduk_id : random_string('alnum', 10)  ?>">
                        <div class="form-group">
                            <label for="produk_id">Nama barang*</label>
                            <select name="produk_id" id="produk_id" class="form-control">
                                <option value="">-Pilih Produk-</option>
                                <?php foreach ($produk as $p) : ?>
                                    <option value="<?= $p->produk_id ?>" <?= $p->produk_id == $row->produk_id ? 'selected' : null ?>><?= $p->nama_produk ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="label">label barang*</label>
                            <input type="text" class="form-control" name="label" id="label" value="<?= $row->label ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="vc">link Landingpage *</label>
                            <input type="text" class="form-control" name="vc" id="vc" value="<?= $row->vc ?>" placeholder="https://link..." required>
                        </div>
                        <div class="form-group">
                            <label for="atc">link Form order *</label>
                            <input type="text" class="form-control" name="atc" id="atc" value="<?= $row->atc ?>" placeholder="https://link..." required>
                        </div>
                        <div class="form-group">
                            <label for="prelander">prelander barang</label>
                            <textarea class="form-control" name="prelander" id="prelander"><?= $row->prelander ?></textarea>
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