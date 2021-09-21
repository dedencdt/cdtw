<!-- Breadcumb -->
<div class="row">
    <div class="col">

        <nav aria-label="breadcrumb ">
            <ol class="breadcrumb bg-transparent">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('komisi/waitingtotf') ?>">Waiting For TF</a></li>
                <li class="breadcrumb-item active" aria-current="page">Komisi Member</li>
            </ol>
        </nav>

    </div>

</div>


<!-- KOLOM INFORMASI -->
<div class="row mb-4">
    <div class="container-fluid">
        <div class="card bg-success text-gray-100">
            <div class="card-body">
                <h5 class="card-title">Intruksi Transfer Komisi</h5>
                <p class="card-text">
                    Perhatikan untuk merekap dengan teliti, Transfer komisi di lakukan secara manual di kirimkan ke data yang sudah tertera jika komisi sudah di transfer silahkan klik tombol
                    <span class="badge badge-primary">Selesai</span> untuk mengubah status menjadi selesai yang berarti komisi sudah di transfer ke tujuan.
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
                <h2>Menunggu Transger</h2>

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
                            <th scope="col">No. Invoice</th>
                            <th scope="col">Total Komisi</th>
                            <th scope="col">status</th>
                            <th scope="col">CS</th>s
                            <th scope="col">Rekening</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $member = $this->fungsi->getsccs($row->tgl_gajian);
                        foreach ($member->result() as $data) :
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $data->invoice ?></td>
                                <td><strong> Rp. <?= number_format($data->diterima) ?></strong></td>
                                <td><span class="badge badge-<?= $data->status != 'menunggu' ? 'success' : 'danger' ?> p-2"><?= $data->status ?></span></td>
                                <td><?= $data->username ?></td>
                                <td><?= $data->rekening ?></td>
                                <td>
                                    <form action="<?= site_url('komisi/process') ?>" method="post">
                                        <!-- hidden input -->
                                        <input type="hidden" name="cskomisi_id" value="<?= $data->cskomisi_id ?>">
                                        <input type="hidden" name="user_id" value="<?= $data->cs_id ?>">
                                        <input type="hidden" name="diterima" value="<?= $data->diterima ?>">
                                        <input type="hidden" name="status" value="selesai">

                                        <button name="cswtf" class="btn btn-primary" onclick="return confirm('Apakah anda yakin sudah Transfer Komisi Rp. <?= number_format($data->diterima) ?> ke Rekening <?= $data->rekening ?> ?')">
                                            <i class="fa fa-hand-holding-usd"></i> Selesai
                                        </button>
                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#ModalRekapkomisi<?= $data->cs_id ?>"><i class="fa fa-info-circle"></i> Details</button>
                                    </form>

                                </td>
                            </tr>

                            <!-- MODAL -->
                            <!-- Modal -->
                            <div class="modal fade" id="ModalRekapkomisi<?= $data->cs_id ?>" tabindex="-1" role="dialog" aria-labelledby="ModalRekapkomisi<?= $data->cs_id ?>Label" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 class="modal-title" id="ModalRekapkomisi<?= $data->cs_id ?>Label">Details Info( <?= $data->username ?> )</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>
                                                <strong><?= $data->nama ?></strong> telah berhasil memperoleh komisi sebesar <strong>Rp. <?= $data->diterima ?></strong> silahkan transfer
                                                ke Rek. <strong><?= $data->rekening ?></strong> <br>
                                                berikut details datanya:
                                            </p>
                                            <!-- hidden -->

                                            <!-- konten -->
                                            <label for="invoice">invoice</label>
                                            <input type="text" name="invoice" id="invoice" class="form-control" value="<?= $data->invoice ?>" readonly>

                                            <label for="tgl_gajian">Tanggal Gajian</label>
                                            <input type="text" name="tgl_gajian" id="tgl_gajian" class="form-control" value="<?= $row->tgl_gajian ?>" readonly>

                                            <label for="komisi_member">Komisi Sales</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text " id="basic-addon1">Rp.</span>
                                                </div>
                                                <!-- input -->
                                                <input type="number" name="komisi_member" id="komisi_member" class="form-control cin-komisi" value="<?= $data->komisi_cs ?>" readonly>
                                            </div>



                                            <label for="note">note</label>
                                            <input type="text" name="note" id="note" class="form-control" value="Pembayaran Komisi Sales -" readonly>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?= $this->pagination->create_links() ?>

            </div>
        </div>
    </div>
</div>

<!-- <script>
    $(document).ready(function() {
        $('.cin-komisi, .cin-rts, .cin-lainlain').keyup(function() {
            let komisi = $('.cin-komisi').val();
            let rts = $('.cin-rts').val();
            let lainlain = $('.cin-lainlain').val();
            let total = komisi - rts - lainlain;

            $('.cin-diterima').val(total);
        });
    });
</script> -->