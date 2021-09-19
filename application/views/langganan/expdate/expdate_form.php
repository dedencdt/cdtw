<!-- Breadcumb -->
<div class="row">

    <div class="col">
        <nav aria-label="breadcrumb ">
            <ol class="breadcrumb bg-transparent">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"> data langganan</li>
            </ol>
        </nav>
    </div>

    <div class="col">
        <a href="<?= site_url() ?>expdate" class="btn btn-warning btn-icon-split float-right">
            <span class="icon text-white-50">
                <i class="fas fa-undo"></i>
            </span>
            <span class="text">Kembali</span>
        </a>
    </div>
</div>

<div class="row">
    <div class="container-fluid">
        <div class="card p-2">
            <div class="card-header text-center">
                <?= ucfirst($page) ?> data
            </div>
            <div class="card-body">
                <!-- form input -->
                <?php

                ?>
                <form method="post" action="<?= site_url('expdate/process') ?>">
                    <div class="row">
                        <div class="col-xl-4 col-md-8 offset-md-2 offset-xl-4">
                            <div class="form-group">
                                <!-- fORM ID HIDDEN -->
                                <input type="hidden" class="form-control" id="expdate_id" name="expdate_id" placeholder="Nama Lengkap" value="<?= $row->expdate_id != '' ? $row->expdate_id : 'cdt' . date('ymd') . random_string('alnum', 21) ?>">
                            </div>
                            <div class="form-group">
                                <label for="masa_exp">Masa aktif</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="">Masa aktif</span>
                                    </div>
                                    <!-- input number -->
                                    <?php $explode = explode(' ', $row->exp_date) ?>
                                    <input type="number" class="form-control form-control-user" id="masa_exp" name="masa_exp" placeholder="Durasi number.. " value="<?= $row->exp_date != '' ? $explode[0] : null ?>" required>
                                    <!-- input format day, week, month , year -->


                                    <select class="form-control" name="format_exp" id="format_exp" required>
                                        <option value="">-Pilih waktu-</option>
                                        <option value="day" <?= ($row->exp_date != '' ? ($explode[1] == 'day' ? 'selected' : null) : null) ?>>Hari</option>
                                        <option value="week" <?= ($row->exp_date != '' ? ($explode[1] == 'week' ? 'selected' : null) : null) ?>>Minggu</option>
                                        <option value="month" <?= ($row->exp_date != '' ? ($explode[1] == 'month' ? 'selected' : null) : null) ?>>Bulan</option>
                                        <option value="year" <?= ($row->exp_date != '' ? ($explode[1] == 'year' ? 'selected' : null) : null) ?>>Tahun</option>
                                    </select>
                                </div>

                            </div>
                            <div class="form-group">
                                <label for="harga">Harga</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="">Rp.</span>
                                    </div>
                                    <input type="number" class="form-control form-control-user" id="harga" name="harga" placeholder="10,000,000" value="<?= $row->harga ?>">
                                </div>
                            </div>
                            <!-- Row tombol -->
                            <div class="row mt-4">
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
                <!-- end form input -->
            </div>
        </div>
    </div>
</div>