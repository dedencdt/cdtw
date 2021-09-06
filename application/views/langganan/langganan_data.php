<!-- Breadcumb -->
<div class="row">
    <div class="col">

        <nav aria-label="breadcrumb ">
            <ol class="breadcrumb bg-transparent">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Langganan</li>
            </ol>
        </nav>

    </div>

    <div class="col">
        <a href="<?= site_url() ?>langganan/add" class="btn btn-primary btn-icon-split float-right">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Perpanjang langganan</span>
        </a>

    </div>
</div>


<!-- TABEL user -->
<div class="row">
    <div class="container-fluid">
        <div class="card p-2">
            <div class="card-header">
                <h2>Daftar langganan</h2>
            </div>
            <div class="card-body table-responsive">

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
                        <span>Results : <?= $total_rows ?></span>
                    </div>
                </div>
                <!-- BATAS PENCARIAN -->
                <?php if ($this->session->flashdata('success')) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= $this->session->flashdata('success'); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php $this->session->unset_userdata('success'); ?>
                <?php endif; ?>
                <table class="table table-hover" id="dataTable">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">No. Invoice</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Username</th>
                            <th scope="col">Durasi</th>
                            <th scope="col">harga</th>
                            <th scope="col">Pembayaran</th>
                            <th scope="col">status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        foreach ($row->result() as $data) : ?>
                            <tr>
                                <td><?= $data->invoice ?></td>
                                <td><?= $data->created_at ?></td>
                                <td><?= $data->username ?></td>
                                <td><?= $data->durasi ?></td>
                                <td>Rp. <?= number_format($data->harga) ?></td>
                                <td><?= $data->paymethod ?></td>
                                <td><?= $data->status ?></td>
                                <td>
                                    <form action="<?= site_url() ?>langganan/process" method="post">
                                        <a href="<?= site_url() ?>langganan/edit/<?= $data->langganan_id ?>" class="btn btn-sm btn-info">
                                            <i class="fa fa-fw fa-edit "></i>
                                            Update
                                        </a>
                                        <a href="<?= site_url() ?>langganan/del/<?= $data->langganan_id ?>" onclick="return confirm('Yakin ingin menghapus ??')" class="btn btn-sm btn-danger">
                                            <i class="fa fa-fw fa-trash "></i>
                                            Delete
                                        </a>
                                        <?php if ($data->status == 'Waiting') : ?>
                                            <!-- HIDDEN INPUT -->
                                            <input type="hidden" name="langganan_id" value="<?= $data->langganan_id ?>">
                                            <input type="hidden" name="status" value="Paid">
                                            <button type="submit" name="konfirmasi" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Konfirmasi</button>
                                        <?php endif; ?>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?= $this->pagination->create_links() ?>

            </div>
        </div>
    </div>
</div>