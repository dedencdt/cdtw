<!-- Breadcumb -->
<div class="row">

    <div class="col">
        <nav aria-label="breadcrumb ">
            <ol class="breadcrumb bg-transparent">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add data langganan</li>
            </ol>
        </nav>
    </div>

    <div class="col">
        <a href="<?= site_url() ?>langganan" class="btn btn-warning btn-icon-split float-right">
            <span class="icon text-white-50">
                <i class="fas fa-undo"></i>
            </span>
            <span class="text">Kembali</span>
        </a>
    </div>
</div>

<?php if ($page == 'edit') : ?>
    <div class="row mb-4">
        <div class="container-fluid">
            <div class="card bg-success text-gray-100">
                <div class="card-body">
                    <h5 class="card-title">Penting !! Harap Baca</h5>
                    <p class="card-text">
                        Halaman edit ini d gunakan hanya untuk mengubah data <strong>STATUS</strong> sajah
                        untuk mengubah status Menjadi <strong>Paid</strong> Karena member akan aktif apabila status tersebut.
                        . <br />
                        Harap di taati, Terimakasih.
                    </p>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<div class="row">
    <div class="container-fluid">
        <div class="card p-2">
            <div class="card-header text-center">
                <?= ucfirst($page) ?> data
            </div>
            <div class="card-body">
                <form method="post" action="<?= site_url('langganan/process') ?>">
                    <div class="row">
                        <div class="col-xl-4 col-md-8 offset-md-2 offset-xl-4">
                            <div class="form-group">
                                <!-- fORM ID HIDDEN -->
                                <input type="hidden" class="form-control" id="langganan_id" name="langganan_id" placeholder="Nama Lengkap" value="<?= $row->langganan_id != '' ? $row->langganan_id : 'cdt' . date('ymd') . random_string('alnum', 21)  ?>">
                            </div>
                            <div class="form-group">
                                <label for="invoice">No. Invoice</label>
                                <input type="text" class="form-control" id="invoice" name="invoice" value="<?= $row->invoice != '' ? $row->invoice : 'SUB/' . date('Ymd') . '/' . strtoupper(random_string('alnum', 4)) ?>">
                            </div>

                            <div class=" form-group">
                                <label for="user_id">Username *</label>
                                <select class="form-control" name="user_id" id="user_id">
                                    <option value="">-Pilih waktu-</option>
                                    <?php foreach ($user->result() as $u) : ?>
                                        <option value="<?= $u->user_id ?>" <?= $u->user_id == $row->user_id ? 'selected' : null ?>><?= $u->nama ?> ( <?= $u->username ?> )</option>
                                    <?php endforeach; ?>

                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exp_date">Expired date</label>
                                <select class="form-control" name="exp_date" id="exp_date">
                                    <option value="">-Pilih waktu-</option>
                                    <?php if (isset($row->durasi)) : ?>
                                        <option value="<?= $row->durasi . '|' . $row->harga ?>" selected><?= $row->durasi ?></option>
                                    <?php endif; ?>
                                    <?php foreach ($expdate->result() as $exp) : ?>
                                        <option value="<?= date('Y-m-d H:i:s', strtotime('+' . $exp->exp_date . '')) . '|' . $exp->harga ?>">
                                            <?= $exp->exp_date ?> - Rp.<?= number_format($exp->harga) ?> </span>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="paymethod">Payment method</label>
                                <select class="form-control" name="paymethod" id="paymethod">
                                    <option value="">-Pilih waktu-</option>
                                    <option value="Transfer" <?= $row->paymethod == 'Transfer' ? 'selected' : null ?>>Transfer</option>
                                    <option value="Potong Komisi" <?= $row->paymethod == 'Potong Komisi' ? 'selected' : null ?>>Potong Komisi</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" name="status" id="status">
                                    <option value="">-Pilih waktu-</option>
                                    <option value="Waiting" <?= $row->status == 'Waiting' ? 'selected' : null ?>>Waiting</option>
                                    <option value="Paid" <?= $row->status == 'Paid' ? 'selected' : null ?>>Paid</option>
                                </select>
                            </div>


                            <!-- Row tombol -->
                            <div class="row">
                                <div class="col">
                                    <input type="submit" class="btn btn-primary btn-block " name="<?= $page ?>" value="Kirim" ">
                                </div>

                                <div class=" col">
                                    <input type="reset" class="btn btn-warning btn-block" name="reset" value="Reset" ">
                                </div>
                            </div>
                            <hr />

                        </div>

                    </div>

                </form>
            </div>
        </div>
    </div>
</div>