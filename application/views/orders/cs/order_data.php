<!-- Breadcumb -->
<div class="row">
    <div class="col">

        <nav aria-label="breadcrumb ">
            <ol class="breadcrumb bg-transparent">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Lead</li>
            </ol>
        </nav>

    </div>

</div>

<!-- TABEL user -->
<div class="row">
    <div class="container-fluid">
        <div class="card p-2">
            <div class="card-header">
                <h2>Lead Masuk</h2>
            </div>
            <div class="card-body table-responsive">
                <?php if ($this->session->flashdata('success')) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= $this->session->flashdata('success'); ?> <span class="float-right"><a href="<?= site_url() ?>orders/followup">Lihat data disini</a></span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php
                    $this->session->unset_userdata('success'); ?>
                <?php endif; ?>

                <table class="table table-hover" id="dataTable">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Order ID</th>
                            <th scope="col">Nama Produk</th>
                            <th scope="col">status</th>
                            <th scope="col">Nama pelanggan</th>
                            <th scope="col">Kota</th>
                            <th scope="col">Ongkir</th>
                            <th scope="col">Total</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($row as $data) : ?>
                            <tr>
                                <td> <?= $no++ ?></td>
                                <td> <?= $data->id ?></td>
                                <td> <?= $data->line_items[0]->name ?></td>
                                <td> <span class=" badge badge-warning p-1"><?= $data->status ?></span></td>
                                <td> <?= $data->billing->first_name ?></td>
                                <td> <?= $data->billing->city ?></td>
                                <td> <?= $data->shipping_total ?></td>
                                <td> <?= $data->total ?></td>
                                <td> <?= $data->date_created ?></td>
                                <td>
                                    <form action="<?= site_url() ?>orders/process" method="post">
                                        <!-- input hidden -->
                                        <input type="hidden" name="in_order_id" value="<?= 'cdt' . date('ymd') . random_string('alnum', 21) ?>">
                                        <input type="hidden" name="orderan_id" value="<?= 'cdt' . date('ymd') . random_string('alnum', 21) ?>">
                                        <input type="hidden" name="order_id" value="<?= $data->id ?>">
                                        <input type="hidden" name="status" value="on-hold">
                                        <input type="hidden" name="penerima" value="<?= $data->billing->first_name  ?>">
                                        <input type="hidden" name="namaproduk" value="<?= $data->line_items[0]->name  ?>">
                                        <input type="hidden" name="alamat" value="<?= $data->billing->address_1 . '~' . $data->billing->address_2 . '~' . $data->billing->city . '~' . $data->billing->state . '~' . $data->billing->postcode  ?>">
                                        <input type="hidden" name="nowa" value="<?= $data->billing->phone ?>">
                                        <input type="hidden" name="frame_id" value="<?= $data->billing->company ?>">
                                        <input type="hidden" name="cs_id" value="<?= $this->fungsi->user_login()->user_id ?>">
                                        <input type="hidden" name="harga" value="<?= $data->line_items[0]->price ?>">
                                        <input type="hidden" name="ongkir" value="<?= $data->shipping_total ?>">
                                        <input type="hidden" name="total" value="<?= $data->total ?>">
                                        <input type="hidden" name="order_created" value="<?= $data->date_created ?>">
                                        <!-- tombol -->
                                        <button type="submit" name="followup" class="btn btn-success">
                                            <i class="fa fa-download text-gray-100"></i> Get data
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>