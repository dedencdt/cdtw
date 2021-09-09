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
</div>

<!-- TABEL user -->
<div class="row">
    <div class="container-fluid">
        <div class="card p-2">
            <div class="card-header">
                <h2>Cek status Lead</h2>
            </div>
            <div class="card-body table-responsive">
                <!-- PENCARIAN INPUT -->
                <div class="row mt-3">
                    <div class="col">
                        <div class="col-md-8 col-sm-8 col-lg-5 float-right">
                            <form action="" method="post">
                                <div class="input-group mb-3">
                                    <input type="text" name="keyword" class="form-control" placeholder="Search cs/publisher/invoice" autocomplete="off">
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

                <table class="table table-hover" id="dataTable" data-url="<?= base_url('orders/get_data_cekorders'); ?>">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Publisher</th>
                            <th scope="col">CS</th>
                            <th scope="col">status</th>
                            <th scope="col">No. Invoice</th>
                            <th scope="col">Nama Produk</th>
                            <th scope="col">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        foreach ($row->result() as $data) :
                        ?>
                            <tr>
                                <td> <?= ++$start ?></td>
                                <td> <?= $data->nama_publisher ?></td>
                                <td> <?= $data->nama_cs ?></td>
                                <td><span class="badge badge-<?= $data->status == 'processing' ? 'warning' : ($data->status == 'packing' ? 'info' : ($data->status == 'delivery' ? 'info' : ($data->status == 'completed' ? 'success' : 'danger'))) ?> p-2"><?= $data->status ?> </span> </td>
                                <td> <?= $data->order_id ?></td>
                                <td> <?= $data->nama_produk ?></td>
                                <td> <?= $data->created_at ?></td>
                            </tr>
                        <?php endforeach; ?>


                    </tbody>
                </table>
                <!-- PASANG PAGINATION -->
                <?= $this->pagination->create_links() ?>
            </div>
        </div>
    </div>
</div>