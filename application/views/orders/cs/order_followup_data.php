<!-- Breadcumb -->
<div class="row">
    <div class="col">

        <nav aria-label="breadcrumb ">
            <ol class="breadcrumb bg-transparent">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Follow Up</li>
            </ol>
        </nav>

    </div>

</div>

<!-- TABEL user -->
<div class="row">
    <div class="container-fluid">
        <div class="card p-2">
            <div class="card-header">
                <h2>Follow by CS (<?= $this->fungsi->user_login()->nama ?>)</h2>

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

                <table class="table table-hover" id="dataTable1" data-url="<?= base_url('orders/get_data_followUpCs') ?>">
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
                            <th scope="col">Tanggal</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        foreach ($row as $data) :
                            $adrs = str_replace('~', ' ', $data->alamat);
                        ?>
                            <tr>
                                <td> <?= ++$start ?></td>
                                <td> <?= $data->order_id ?></td>
                                <td> <?= $data->nama_produk ?></td>
                                <td> <span class="badge badge-info"><?= $data->status ?></span></td>
                                <td> <?= $data->penerima ?></td>
                                <td> <?= $adrs ?></td>
                                <td> <?= $data->nowa ?></td>
                                <td> <?= $data->total ?></td>
                                <td> <?= $data->created_at ?></td>
                                <td>
                                    <?php
                                    // TEKS WHATSAPP
                                    $text = "Hai ka {$data->penerima} , pesanannya sudah kami terima,\r \n \r \n*Details Order* \r \n *InvoiceID* : #{$data->order_id}\r \n *Pesanan* : {$data->nama_produk}\r \n *Harga* : {$data->ongkir}  \r \n *Ongkir* : {$data->ongkir}  \r \n *Total* : {$data->total} \r \n \r \n*Detail Alamat* \r \n *Penerima* : {$data->penerima} \r \n*No. Whatsapp* : {$data->nowa} \r \n *Alamat* : {$data->alamat} \r \n \r \n Jika data sudah benar silahkan *konfirmasi* agar segera kami proses untuk pengiriman.\r \n\r \n _note*_ : _jika ada data yang salah mohon kirimkan data validnya ke nomer ini, Terimakasih_ 
                                        ";

                                    ?>
                                    <?php if ($data->status == 'on-hold') : ?>
                                        <div class="row">
                                            <a href="<?= $this->fungsi->sendwa($data->nowa, $text) ?>" target="_blank">
                                                <button class="btn btn-success"><i class="fab fa-whatsapp"></i> Follow up</button>
                                            </a>
                                            <button class="btn btn-info" data-toggle="modal" data-target="#detailorder<?= $data->in_order_id ?>"><i class=" fa fa-info"></i> Edit</button>
                                            <!-- UBAH STATUS -->
                                            <form action="<?= site_url('orders/process') ?>" method="post">
                                                <!-- data optional -->

                                                <!-- data hidden for orderan -->
                                                <input type="hidden" name="orderan_id" value="<?= $data->orderan_id ?>">
                                                <input type="hidden" name="in_order_id" value="<?= $data->in_order_id ?>">
                                                <input type="hidden" name="vendor_id" value="<?= $this->fungsi->getVendorOrder($data->produk_id)->vendor_id ?>">
                                                <div class="input-group">
                                                    <select class="custom-select" id="status" name="status" required>
                                                        <option value="">- status -</option>
                                                        <option value="packing">Packing</option>
                                                        <option value="junk">Junk Order</option>
                                                        <option value="cencelled">Cencelled</option>
                                                    </select>
                                                    <div class="input-group-append">
                                                        <button class="btn text-gray-100 bg-warning" type="submit" name="ubahstatus" onclick="return confirm('Pastikan Sudah memfollow up pembeli dengan sungguh sungguh !!')">Ubah</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    <?php endif; ?>
                                </td>
                            </tr>

                            <!-- modal mulai -->
                            <div class="row">
                                <div class="col">
                                    <div class="modal fade" id="detailorder<?= $data->in_order_id ?>" tabindex="-1" aria-labelledby="detailorder<?= $data->in_order_id ?>Label" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="detailorder<?= $data->in_order_id ?>Label"><strong>Perbarui Informasi</strong></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="<?= site_url('orders/process') ?>" method="post">
                                                    <div class="modal-body">
                                                        <!-- hidden ID -->
                                                        <div class="form-group">
                                                            <label for="in_order_id" class="col-form-label">Invoice ID</label>
                                                            <span>#<?= $data->order_id ?></span>
                                                            <input type="hidden" class="form-control" id="in_order_id" name="in_order_id" value="<?= $data->in_order_id ?>" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="penerima" class="col-form-label">Nama penerima</label>
                                                            <input type="text" class="form-control" id="penerima" name="penerima" value="<?= $data->penerima ?>" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="nowa" class="col-form-label">No. Hp</label>
                                                            <input type="number" class="form-control" id="nowa" name="nowa" value="<?= $data->nowa ?>" />
                                                        </div>
                                                        <div class="form-group">
                                                            <?php
                                                            $alamat =  explode('~', $data->alamat);
                                                            $jln = $alamat[0];
                                                            $add1 = explode(',', $alamat[1]);
                                                            $kelurahan =  $add1[0];
                                                            $kecamatan = $add1[1];
                                                            $kota = $alamat[2];
                                                            $prov = $alamat[3];
                                                            $kodepos = $alamat[4];
                                                            ?>
                                                            <label for="prov" class="col-form-label">Provinsi</label>
                                                            <input type="text" class="form-control" id="prov" name="prov" placeholder="Provinsi" value="<?= $prov ?>" />
                                                            <label for="kota" class="col-form-label">Kota</label>
                                                            <input type="text" class="form-control" id="kota" name="kota" placeholder="Kota" value="<?= $kota ?>" />
                                                            <label for="kec" class="col-form-label">Kecamatan</label>
                                                            <input type="text" class="form-control" id="kec" name="kec" placeholder="Kecamata" value="<?= $kecamatan ?>" />
                                                            <label for="kodepos" class="col-form-label">Kode post</label>
                                                            <input type="number" class="form-control" id="kodepos" name="kodepos" placeholder="Kode POST" value="<?= $kodepos ?>" />
                                                            <label for="alamat2" class="col-form-label">Desa/Kelurahan</label>
                                                            <input type="text" class="form-control" id="alamat2" name="alamat2" placeholder="Kelurahan/Dusun" value="<?= $kelurahan ?>" />
                                                            <label for="alamat1" class="col-form-label">Jln/Rumah xx</label>
                                                            <input type="text" class="form-control" id="alamat1" name="alamat1" placeholder="Jln/Gedung/kantor/rumah dll" value="<?= $jln ?>" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="alamat" class="col-form-label">Priview :</label>
                                                            <br /><span id="privAlamat" class="text-info"></span>
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

                    </tbody>
                </table>
                <!-- PASANG PAGINATION -->
                <?= $this->pagination->create_links() ?>

            </div>
        </div>
    </div>
</div>
<script>
    var prov = $('#prov');
    var kota = $('#kota');
    var kec = $('#kec');
    var kodepos = $('#kodepos');
    var alamat2 = $('#alamat2');
    var alamat1 = $('#alamat1');


    $('#privAlamat').text(alamat1.val() + ' ' + alamat2.val() + ' ' + kec.val() + ' ' + kota.val() + ' ' + prov.val() + ' ' + kodepos.val());
</script>