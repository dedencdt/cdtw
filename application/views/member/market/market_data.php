<!-- Breadcumb -->
<div class="row">
    <div class="col">

        <nav aria-label="breadcrumb ">
            <ol class="breadcrumb bg-transparent">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Marketplace</li>
            </ol>
        </nav>

    </div>

</div>

<!-- KOLOM TOMBOL PERPANJANG -->
<div class="row mb-4">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2 float-xl-left ml-0">
                        <h5 class="card-title">Filter : </h5>

                    </div>
                    <div class="col-md-3 col-sm-3  float-sm-right float-xl-left">
                        <select class="form-control" name="" id="">
                            <option value="">Level 1</option>
                            <option value="">Level 2</option>
                            <option value="">Level 3</option>
                        </select>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- TABEL user -->
<div class="row">
    <div class="container-fluid">
        <div class="card p-2">
            <div class="card-body table-responsive">

                <!-- isi konten -->
                <div class="row">
                    <?php foreach ($row->result() as $data) : ?>
                        <div class="col-md-6 col-xl-4 float-left p-1">
                            <div class="card col-md-12">
                                <div class="card-body">
                                    <img src="<?= $data->gambar != '' ? $data->gambar : site_url('assets/img/undraw_posting_photo.svg') ?>" class="card-img-top" alt="<?= $data->nama_produk ?>">
                                </div>
                                <div class="card-body ">
                                    <h5 class="card-title"><?= $data->nama_produk ?></h5>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">Harga Produk : <strong> Rp. <?= number_format($data->harga) ?></strong></li>
                                        <li class="list-group-item">Komisi Affiliate : <strong>Rp. <?= number_format($data->komisi) ?></strong></strong></li>
                                        <li class="list-group-item">Stock: <strong> <?= $data->stock ?></strong></li>
                                    </ul>
                                    <?php if ($data->harga != 0 && $data->komisi != 0) : ?>
                                        <a href="<?= site_url() . 'market/link/' . $data->produk_id ?>" class="card-link float-right">Link Affiliate</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>


            </div>
        </div>
    </div>
</div>