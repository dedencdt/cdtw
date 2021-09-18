<!-- Breadcumb -->
<div class="row">
    <div class="col">

        <nav aria-label="breadcrumb ">
            <ol class="breadcrumb bg-transparent">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Packing</li>
            </ol>
        </nav>

    </div>
    <?php if ($this->db->affected_rows() > 0) :  ?>
        <div class="col">
            <a href="<?= site_url() ?>orders/toexcel" class="btn btn-default btn-icon-split float-right">
                <span class="icon text-white-50">
                    <i class="fas fa-print"></i>
                </span>
                <span class="text"> export <strong><?= $this->db->affected_rows() ?> data</strong></span>
            </a>
        </div>
    <?php endif; ?>
</div>

<!-- TABEL user -->
<div class="row">
    <div class="container-fluid">
        <div class="card p-2">
            <div class="card-header">
                <h2>Packing & Input Resi</h2>

            </div>
            <div class="card-body table-responsive">
                <?php if ($this->session->flashdata('success')) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= $this->session->flashdata('success'); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php
                    $this->session->unset_userdata('success'); ?>
                <?php endif; ?>

                <table class="table table-hover" id="dataTable1">

                    <!-- PENCARIAN INPUT -->
                    <div class="row mt-3">
                        <div class="col">
                            <div class="col-md-8 col-sm-8 col-lg-5 float-right">
                                <form action="" method="post">
                                    <div class="input-group mb-3">
                                        <input type="text" name="keyword" class="form-control" placeholder="Search Keyword.." autocomplete="off">
                                        <div class="input-group-append">
                                            <input class="btn btn-primary" type="submit" value="Cari" name="search" id="search">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <span>
                                Results :
                                <?php if ($this->input->post('search')) : ?>
                                    <?= $total_rows = $total_rows  != 0 ? " <strong>  {$total_rows} </strong> " : '<strong class="alert alert-danger alert-dismissible fade show">Data tidak di temukan!! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></strong>' ?>
                                <?php endif; ?>
                                <?php if (!$this->input->post('search')) : ?>
                                    <?= $this->db->affected_rows(); ?>
                                <?php endif; ?>
                            </span>
                        </div>
                    </div>

                    <!-- BATAS PENCARIAN -->
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">No. Invoice</th>
                            <th scope="col">Nama Produk</th>
                            <th scope="col">status</th>
                            <th scope="col">Nama pelanggan</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">No Wa</th>
                            <th scope="col">Total</th>
                            <th scope="col">Resi</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($row as $data) :
                            $adrs = str_replace('~', ' ', $data->alamat);
                        ?>
                            <tr>
                                <td> <?= $no++ ?></td>
                                <td> <?= $data->order_id ?></td>
                                <td> <?= $data->nama_produk ?></td>
                                <td> <?= $data->status ?></td>
                                <td> <?= $data->penerima ?></td>
                                <td> <?= $adrs ?></td>
                                <td> <?= $data->nowa ?></td>
                                <td> <?= $data->total ?></td>
                                <td> <?= $data->resi ?></td>
                                <td> <?= $data->created_at ?></td>
                                <td>
                                    <div class="row">
                                        <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#detailorder<?= $data->in_order_id ?>"><i class=" fa fa-shipping-fast"></i> Input resi</button>
                                    </div>
                                </td>
                            </tr>

                            <!-- modal mulai -->
                            <div class="row">
                                <div class="col">
                                    <div class="modal fade" id="detailorder<?= $data->in_order_id ?>" tabindex="-1" aria-labelledby="detailorder<?= $data->in_order_id ?>Label" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="detailorder<?= $data->in_order_id ?>Label"><strong>Input Resi </strong></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="<?= site_url('packing/process') ?>" method="post">
                                                    <!-- HIDDEN INPUT -->
                                                    <input type="hidden" name="orderan_id" value="<?= $data->orderan_id ?>">
                                                    <input type="hidden" name="in_order_id" value="<?= $data->in_order_id ?>">
                                                    <input type="hidden" name="vendor_id" value="<?= $data->vendor_id ?>">


                                                    <!-- modal body -->
                                                    <input type="hidden" name="status" value="delivery">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="resi" class="col-form-label">No. Resi / AWB</label>
                                                            <input type="text" class="form-control" id="resi" name="resi" placeholder="JNXXXX.." value="<?= $data->resi ?>" />
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <input type="submit" class="btn btn-primary" name="editResi" value="Simpan">
                                                        </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- modal end -->
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?= $this->pagination->create_links() ?>

            </div>
        </div>
    </div>
</div>