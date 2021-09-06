<!-- Breadcumb -->
<div class="row">
    <div class="col">

        <nav aria-label="breadcrumb ">
            <ol class="breadcrumb bg-transparent">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Proses COD</li>
            </ol>
        </nav>

    </div>
</div>

<!-- TABEL user -->
<div class="row">
    <div class="container-fluid">
        <div class="card p-2">
            <div class="card-header">
                <h2>Proses COD</h2>

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
                                    <form action="<?= base_url('orders/process') ?>" method="post">
                                        <!-- hidden input -->
                                        <input type="hidden" name="order_id" value="<?= $data->order_id ?>">
                                        <input type="hidden" name="in_order_id" value="<?= $data->in_order_id ?>">
                                        <input type="hidden" name="orderan_id" value="<?= $data->orderan_id ?>">
                                        <div class="input-group">
                                            <select class="custom-select" id="status" name="status" required>
                                                <option value="">- status -</option>
                                                <option value="completed">Delivered</option>
                                                <option value="refunded">RTS</option>
                                            </select>
                                            <div class="input-group-append">
                                                <button class="btn text-gray-100 bg-warning" type="submit" name="lastedit">Ubah</button>
                                            </div>
                                        </div>
                                    </form>
                                </td>
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