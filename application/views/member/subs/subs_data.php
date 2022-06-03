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

</div>

<!-- KOLOM INFORMASI -->
<!-- Card peringatan akun nonaktif -->
<div class="row cdt-notiftolangganan">
    <div class="container-fluid">
        <div class="card text-white bg-danger mb-3 " style="max-width: 100%;">
            <div class="card-header bg-danger">Pemberitahuan</div>
            <div class="card-body">
                <h5 class="card-title">Akun anda belum aktif</h5>
                <p class="card-text">Silahkan klik perpanjang untuk mengaktifkan member, <br>
                    Klik Tombol Perpanjang > Pilih Durasi & Metode Pembayaran > Klik Perpanjang Sekarang <br>
                    Setelah itu ikuti petunjuk yang ada.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Card Invoice Created -->
<div class="row cdt-invMember">
    <div class="container-fluid">
        <div class="card text-white bg-info mb-3 " style="max-width: 100%;">
            <div class="card-header bg-info">Pesan Pemberitahuan</div>
            <div class="card-body">
                <h5 class="card-title">Tagihan langganan member</h5>
                <p class="card-text">Hai ka nama, ini adalah pemberitahuan tagihan yang di buat pada TGL <br>
                    dengan metode pembayaran : Transfer ( Manual )<br>
                    <br> No. Invoice : INV
                    <br> Jumlah Tagian :

                    <br><br>
                    <strong>Invoice Items</strong> <br>
                    Perpanjang Langanan Member DURASI,

                    <br><br>
                    <strong>Pembayaran</strong><br>
                    Bank Jago : 1231XXXX
                    <br>A.n XXXXXX
                    <br> Jangan lupa untuk konfirmasi pembayaran melalui Live chat atau link <br>
                    linkk,


                </p>
            </div>
        </div>
    </div>
</div>



<!-- KOLOM TOMBOL PERPANJANG -->
<div class="row mb-4">
    <div class="container-fluid">
        <div class="card text-center">
            <div class="card-body">
                <h6 class="card-title">Akun anda <?= $this->fungsi->durasi_langganan() <= date('Y-m-d') ? "<span class='badge badge-danger p-1'>tidak aktif</span>"  : "Aktif Sampai <i class='fas fa-fw fa-check text-success'></i>" ?></h6>
                <h5 class="card-title"><strong><?= $this->fungsi->durasi_langganan() ?> </strong> <br></h5>
                <p class="card-text">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Perpanjang</button>
                </p>
            </div>
        </div>
    </div>
</div>

<!-- TABEL user -->
<div class="row">
    <div class="container-fluid">
        <div class="card p-2">

            <div class="card-body table-responsive">
                <?php if ($this->session->flashdata('success')) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= $this->session->flashdata('success'); ?>
                        <?php
                        $userlangganan = $this->fungsi->user_login()->username;
                        $urllangganan = site_url('langganan');
                        $text = "**Notifikasi - Perpanjang member : $userlangganan ** \r \n Data perpanjan masa aktif codtech diterima. \r \n silahkan cek di : {$urllangganan} dan silahkan tunggu konfirmasi pembayaran";
                        $this->fungsi->apitele($this->setter->get_idteleadmin(), $text, $this->setter->get_tokenteleadmin())
                        ?>
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
                            <th scope="col">Durasi</th>
                            <th scope="col">harga</th>
                            <th scope="col">Pembayaran</th>
                            <th scope="col">status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        foreach ($row as $data) : ?>
                            <tr>
                                <td><?= $data->invoice ?></td>
                                <td><?= $data->created_at ?></td>
                                <td><?= $data->durasi ?></td>
                                <td>Rp. <?= number_format($data->harga) ?></td>
                                <td><?= $data->paymethod ?></td>
                                <td data-status="<?= $data->status ?>"><?= $data->status ?></td>
                                <!-- setting card petunjuk langganan -->
                                <?php

                                // CEK AKUN tidak
                                if ($this->fungsi->durasi_langganan() <= date('Y-m-d')) {
                                    echo "
                                            <script>
                                           document.querySelector('.cdt-notiftolangganan').classList.toggle('d-none');
                                            // document.querySelector('.cdt-invMember').setAttribute('style','display:none');
                                            </script>
                                            ";
                                } elseif ($data->status == "Waiting") {
                                    echo "
                                            <script>
                                        //    document.querySelector('.cdt-notiftolangganan').classList.toggle('d-none');
                                          document.querySelector('.cdt-invMember').classList.toggle('d-none');
                                            </script>
                                            ";
                                }
                                // if (!$data->status == "Waiting" || $data->status == null) {
                                //     // tampilkan card
                                //     echo "
                                //                 <script>
                                //                document.querySelector('.cdt-notiftolangganan').classList.toggle('d-none');
                                //                 // document.querySelector('.cdt-invMember').setAttribute('style','display:none');
                                //                 </script>
                                //                 ";
                                // } else {
                                //     // matikan card
                                //     echo "
                                //                 <script>
                                //                 document.querySelector('.cdt-invMember').setAttribute('style','display:block');
                                //                 </script>
                                //                 ";
                                // }
                                //         // Langganan aktif
                                ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?= $this->pagination->create_links() ?>
            </div>
        </div>
    </div>
</div>

<!-- modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Perpanjang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- FORM START -->
                <form action="<?= site_url('subs/process') ?>" method="post">

                    <!-- Create ID -->
                    <input type="hidden" class="form-control" id="langganan_id" name="langganan_id" placeholder="Nama Lengkap" value="<?= 'cdt' . date('ymd') . random_string('alnum', 21) ?>">
                    <!-- Invoice -->
                    <input type="hidden" class="form-control" id="invoice" name="invoice" value="<?= 'SUB/' . date('Ymd') . '/' . strtoupper(random_string('alnum', 4)) ?>">
                    <!-- get UserID -->
                    <input type="hidden" name="user_id" id="user_id" value="<?= $this->fungsi->user_login()->user_id ?>">
                    <!-- status -->
                    <input type="hidden" name="status" id="status" value="Waiting">
                    <!-- email -->
                    <input type="hidden" name="email" id="email" value="<?= $this->fungsi->user_login()->email ?>">


                    <!-- durasi -->
                    <div class="form-group">
                        <label for="exp_date">Pilih durasi </label>
                        <?php foreach ($expdate->result() as $exp) : ?>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="exp_date" id="exp_date" value=" <?= date('Y-m-d H:i:s', strtotime('+' . $exp->exp_date . '')) . '|' . $exp->harga ?>" required>
                                <label class="form-check-label" for="exp_date">
                                    <?= $exp->exp_date ?> - Rp.<?= number_format($exp->harga) ?>
                                </label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="form-group">
                        <label for="paymethod" class="col-form-label">Metode Pembayaran</label>
                        <select class="form-control" name="paymethod" id="paymethod" required>
                            <option value="">-Pilih-</option>
                            <option value="Transfer">Transfer</option>
                            <option value="Potong Komisi">Potong Komisi</option>
                        </select>
                    </div>

                    <!-- Row tombol -->
                    <div class="row">
                        <div class=" col">
                        </div>
                        <div class="col">
                            <input type="submit" class="btn btn-primary btn-block " name="add" value="Perpanjang Sekarang">
                        </div>

                    </div>
                    <hr />
                </form>

            </div>
        </div>
    </div>
</div>