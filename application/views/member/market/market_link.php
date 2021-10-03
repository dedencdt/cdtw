<!-- Breadcumb -->
<div class="row">
    <div class="col">

        <nav aria-label="breadcrumb ">
            <ol class="breadcrumb bg-transparent">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('market') ?>">Marketplace</a></li>
                <li class="breadcrumb-item active" aria-current="page">Link affiliate</li>
            </ol>
        </nav>

    </div>

</div>

<!-- KOLOM TOMBOL PERPANJANG -->

<!-- TABEL user -->
<div class="row">
    <div class="container-fluid container-xs">
        <div class="card p-2">
            <div class="card-body table-responsive">

                <!-- isi konten -->
                <div class="row">

                    <?php foreach ($row->result() as $data) : ?>
                        <div class="col-md-6 col-lg-4 col-sm-6 col-xs-12 float-left p-3">
                            <div class="card col-md-12">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <span class="card-title"> <strong>Link Affiliate</strong> </span>
                                        <span class="float-right"><button class="btn btn-success btn-sm" data-toggle="modal" data-target="#settingpixel<?= $data->frame_id ?>">Setting</button></span>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Link Form langsung</strong>
                                        <!-- create parameter url -->
                                        <?php $p = ['reff_cdt' => $data->frame_id] ?>
                                        <br> <a href="<?= $data->atc . '?' . http_build_query($p) ?>" class="card-link"><?= $data->atc . '?' . http_build_query($p) ?></a>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Landing page</strong>
                                        <!-- create parameter url -->
                                        <br> <a href="<?= $data->vc . '?' . http_build_query($p) ?>" class="card-link"><?= $data->vc . '?' . http_build_query($p) ?></a>
                                    </li>
                                    <li class="list-group-item"> <strong>Prelander </strong>
                                        <br>
                                        <div class="row">
                                            <div class="col">

                                                <a href="<?= site_url() . 'market/export/' . $data->linkproduk_id ?>" target="_blank" rel="noopener noreferrer"><button class="btn bg-light"><i class="fa fa-file-download"></i> XML(Blogspot)</button></a>
                                            </div>

                                            <div class="col">
                                                <a href="<?= site_url() . 'market/export/' . $data->linkproduk_id ?>" target="_blank" rel="noopener noreferrer"><button class="btn bg-light"><i class="fa fa-file-download"></i> HTML(Shopify)</button></a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <div class="card-footer bg-transparent">
                                    <a href="<?= site_url() . 'market/del/' . $data->frame_id ?>" class="float-right"><button class="btn btn-danger btn-sm">Hapus</button></a>
                                </div>
                            </div>
                        </div>
                        <!-- modal mulai -->
                        <div class="row">
                            <div class="col">
                                <div class="modal fade" id="settingpixel<?= $data->frame_id ?>" tabindex="-1" aria-labelledby="settingpixel<?= $data->frame_id ?>Label" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="settingpixel<?= $data->frame_id ?>Label"><strong>Pengaturan</strong></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="<?= site_url('market/process') ?>" method="post">
                                                <div class="modal-body">
                                                    <!-- hidden ID -->
                                                    <input type="hidden" name="frame_id" value="<?= $data != '' ? $data->frame_id : null ?>">
                                                    <div class="form-group">
                                                        <label for="labelset" class="col-form-label">Label</label>
                                                        <input type="text" class="form-control" id="labelset" name="labelset" value="<?= $data != '' ? $data->label : null ?>" />
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="fbpixel1" class="col-form-label">Facebook pixel 1</label>
                                                        <input type="text" class="form-control" id="fbpixel1" name="fbpixel1" value="<?= $data != '' ? $data->fbpx1 : null ?>" />
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="fbpixel2" class="col-form-label">Facebook pixel 2</label>
                                                        <input type="text" class="form-control" id="fbpixel2" name="fbpixel2" value="<?= $data != '' ? $data->fbpx2 : null ?>" />
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="hiddinkey" class="col-form-label">Hidden Keyword:</label>
                                                        <textarea class="form-control" id="hidden_key" name="hidden_key"><?= $data != '' ? $data->hidden_key : null ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <input type="submit" class="btn btn-primary" name="edit" value="Simpan">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- modal end -->

                    <?php endforeach; ?>
                </div>
                <div class="row">
                    <div class="col">
                        <form action="<?= site_url('market/process') ?>" method="post">
                            <!-- GENRATE ID-->
                            <input type="hidden" name="marketlink_id" id="marketlink_id" value="<?= 'cdt' . date('ymd') . random_string('alnum', 21) ?>">
                            <input type="hidden" name="frame_id" id="frame_id" value="<?= 'cdt' . date('ymd') . random_string('alnum', 21) ?>">
                            <!-- GET ID -->
                            <input type="hidden" name="user_id" id="user_id" value="<?= $this->fungsi->user_login()->user_id  ?>">
                            <input type="hidden" name="produk_id" id="produk_id" value="<?= $produk->produk_id  ?>">
                            <input type="hidden" name="linkproduk_id" id="linkproduk_id" value="<?= $linkproduk->linkproduk_id  ?>">

                            <input type="submit" name="add" class="float-left btn btn-info btn-sm" value="Tambah link" />
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>