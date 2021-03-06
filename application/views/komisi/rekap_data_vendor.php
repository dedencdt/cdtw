<!-- Breadcumb -->
<div class="row">
    <div class="col">

        <nav aria-label="breadcrumb ">
            <ol class="breadcrumb bg-transparent">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('komisi/settanggal') ?>">settanggal</a></li>
                <li class="breadcrumb-item active" aria-current="page">Rekap Komisi Vendor</li>
            </ol>
        </nav>

    </div>

</div>

<?php
$no = 1;
$tgl = new DateTime($row->tutup_buku);
$bukabuku = $tgl->modify('-7 day');
?>

<!-- KOLOM INFORMASI -->
<div class="row mb-4">
    <div class="container-fluid">
        <div class="card bg-success text-gray-100">
            <div class="card-body">
                <h5 class="card-title">Intruksi Rekap data</h5>
                <p class="card-text">
                    Perhatikan untuk mengisi rekapan dengan teliti
                </p>
            </div>
        </div>
    </div>
</div>


<!-- TABEL user -->
<div class="row">
    <div class="container-fluid">
        <div class="card p-2">
            <div class="card-header">
                <h2>Dana Siap Cair Vendor</h2>

            </div>
            <div class="card-body table-responsive">
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
                            <th scope="col">#</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Vendor</th>
                            <th scope="col">Komisi Sales</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $vendor = $this->fungsi->getdataKomisiVendor($bukabuku->format('Y-m-d'), $row->tutup_buku);
                        foreach ($vendor->result() as $data) :
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $row->tgl_gajian ?></td>
                                <td><?= $data->username ?></td>
                                <td>Rp. <?= $data->komisi_vendor ?></td>
                                <td>
                                    <?php if (!$this->fungsi->cek_data_komisi_vendor($row->tgl_gajian, $data->vendorid) > 0) { ?>
                                        <?php if (date('Y-m-d') == $row->tgl_rekap) : ?>
                                            <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#ModalRekapkomisi<?= $data->vendorid ?>">
                                                <i class="fa fa-fw fa-edit "></i>
                                                Rekap Komisi
                                            </button>
                                        <?php else : ?>
                                            <span class="badge badge-danger">Rekapan Tersedia tgl : <?= date('d M Y', strtotime($row->tgl_rekap)) ?></span>
                                        <?php endif; ?>
                                    <?php } else { ?>
                                        <span class="badge badge-success p-2">Sudah di Rekap</span>
                                    <?php } ?>
                                </td>
                            </tr>
                            <!-- MODAL -->
                            <!-- Modal -->
                            <div class="modal fade" id="ModalRekapkomisi<?= $data->vendorid ?>" tabindex="-1" role="dialog" aria-labelledby="ModalRekapkomisi<?= $data->vendorid ?>Label" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <form action="<?= site_url('komisi/process') ?>" method="post">

                                            <div class="modal-header">
                                                <h5 class="modal-title" id="ModalRekapkomisi<?= $data->vendorid ?>Label">Rekap Komisi Member( <?= $data->username ?> )</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                <!-- hidden -->
                                                <input type="hidden" name="vendorid" id="cs" class="form-control" value="<?= $data->vendorid ?>">
                                                <input type="hidden" name="status" id="status" class="form-control" value="menunggu">
                                                <input type="hidden" name="vkomisi_id" id="cskomisi_id" class="form-control" value="<?= 'cdt' . date('ymd') . random_string('alnum', 21) ?>">


                                                <!-- konten -->
                                                <label for="invoice">invoice</label>
                                                <input type="text" name="invoice" id="invoice" class="form-control" value="<?= 'CDSC/' . date('ymd') . '/' . strtoupper(random_string('alnum', 5)) ?>" readonly>

                                                <label for="tgl_gajian">Tanggal Gajian</label>
                                                <input type="text" name="tgl_gajian" id="tgl_gajian" class="form-control" value="<?= $row->tgl_gajian ?>" readonly>

                                                <label for="komisi_vendor">Komisi Sales</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text " id="basic-addon1">Rp.</span>
                                                    </div>
                                                    <!-- input -->
                                                    <input type="number" name="komisi_vendor" id="komisi_vendor" class="form-control cin-komisi" value="<?= $data->komisi_vendor ?>" readonly>
                                                </div>

                                                <label for="note">note</label>
                                                <input type="text" name="note" id="note" class="form-control" value="Pembayaran Komisi Vendor -">

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary" name="savetokomisivendor" onclick="return confirm('Apakah anda yakin semua data rekapan sudah benar ?')">Rekap</button>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- batas modal -->
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?= $this->pagination->create_links() ?>

            </div>
        </div>
    </div>
</div>