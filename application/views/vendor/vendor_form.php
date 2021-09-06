<!-- Breadcumb -->
<div class="row">

    <div class="col">
        <nav aria-label="breadcrumb ">
            <ol class="breadcrumb bg-transparent">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"> data langganan</li>
            </ol>
        </nav>
    </div>

    <div class="col">
        <a href="<?= site_url() ?>vendor/data" class="btn btn-warning btn-icon-split float-right">
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
                <!-- form input -->
                <?php

                ?>
                <form method="post" action="<?= site_url('vendor/process') ?>">
                    <div class="row">
                        <div class="col-xl-4 col-md-8 offset-md-2 offset-xl-4">
                            <div class="form-group">
                                <!-- fORM ID HIDDEN -->
                                <input type="hidden" class="form-control" id="vendor_id" name="vendor_id" placeholder="Nama Lengkap" value="<?= $row->vendor_id != '' ? $row->vendor_id : random_string('alnum', 10)  ?>">
                            </div>
                            <div class="form-group">
                                <label for="vendor_name">Nama* </label>
                                <div class="input-group">
                                    <select name="vendor_name" id="vendor_name" class="form-control">
                                        <option value="">-pilih vendor-</option>
                                        <?php foreach ($vendor as $v) : ?>
                                            <option value="<?= $v->user_id ?>" <?= $v->user_id == $row->user_id ? 'selected' : null ?>><?= $v->nama ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="harga">Nama produk </label>
                                <div class="input-group">
                                    <div class="input-group">
                                        <select name="produk_name" id="produk_name" class="form-control">
                                            <option value="">-pilih produk-</option>
                                            <?php foreach ($produk as $p) : ?>
                                                <option value="<?= $p->produk_id ?>" <?= $p->produk_id == $row->produk_id ? 'selected' : null ?>><?= $p->nama_produk ?></option>
                                            <?php endforeach; ?>
                                            <option value=""> nama </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- Row tombol -->
                            <div class="row mt-4">
                                <div class="col">
                                    <input type="submit" class="btn btn-primary btn-block " name="<?= $page ?>" value="Kirim" ">
                                </div>

                                <div class=" col">
                                    <input type="reset" class="btn btn-warning btn-block" name="reset" value="Reset" ">
                                </div>
                            </div>
                            <hr />

                        </div>

                    </div>

                </form>
                <!-- end form input -->
            </div>
        </div>
    </div>
</div>