<!-- Breadcumb -->
<div class="row">

    <div class="col">
        <nav aria-label="breadcrumb ">
            <ol class="breadcrumb bg-transparent">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah data pengguna</li>
            </ol>
        </nav>
    </div>

    <div class="col">
        <a href="<?= site_url() ?>user" class="btn btn-warning btn-icon-split float-right">
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
                Formulir tambah data
            </div>
            <div class="card-body">
                <?php if (validation_errors()) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= validation_errors() ?>
                    </div>
                <?php endif; ?>
                <form method="post" action="">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="nama">Nama lengkap *</label>
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap" value="<?= set_value('nama') ?>">
                                <!-- fORM ID HIDDEN -->
                                <input type="hidden" class="form-control" id="user_id" name="user_id" placeholder="Nama Lengkap" value="<?= random_string('alnum', 10) ?>">
                            </div>
                            <div class="form-group">
                                <label for="username">Username *</label>
                                <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Username.." value="<?= set_value('username') ?>">
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label for="password">Password *</label>
                                    <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password" value="<?= set_value('password') ?>">
                                </div>
                                <div class="col-sm-6">
                                    <label for="passconf">Konfirmasi Password *</label>
                                    <input type="password" class="form-control form-control-user" id="passconf" name="passconf" placeholder="Repeat Password" value="<?= set_value('passconf') ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">Email *</label>
                                <input type="email" class="form-control form-control-user" id="email" name="email" placeholder="example@ex.com" value="<?= set_value('email') ?>">
                            </div>
                            <div class="form-group">
                                <label for="nohp">No HP / Whatsapp *</label>
                                <input type="number" class="form-control form-control-user" id="nohp" name="nohp" placeholder="No. HP / Whatsapp" value="<?= set_value('nohp') ?>">
                            </div>
                            <div class="form-group">
                                <label for="rekening">Rekening</label>
                                <input type="text" class="form-control form-control-user" id="rekening" name="rekening" placeholder="Rekening ex; BRI 09831312 An Nama.." value="<?= set_value('rekening') ?>">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="role">Role *</label>
                                <select class="form-control" name="role" id="role">
                                    <option value="">-Pilih Role-</option>
                                    <option value="1" <?= set_value('role') == 1 ? 'selected' : null ?>>Admin</option>
                                    <option value="2" <?= set_value('role') == 2 ? 'selected' : null ?>>Member</option>
                                    <option value="3" <?= set_value('role') == 3 ? 'selected' : null ?>>Customer Sevice</option>
                                    <option value="4" <?= set_value('role') == 4 ? 'selected' : null ?>>Vendor</option>
                                    <option value="5" <?= set_value('role') == 5 ? 'selected' : null ?>>Packing</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea class="form-control form-control-user" name="alamat" id="alamat" placeholder="Masukan alamat.."><?= set_value('alamat') ?></textarea>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <input type="submit" class="btn btn-primary btn-block " name="submit" value="Kirim" ">
                                </div>

                                <div class=" col">
                                    <input type="reset" class="btn btn-warning btn-block" name="reset" value="Reset" ">
                                </div>
                            </div>

                            <hr>

                        </div>

                    </div>

                </form>
            </div>
        </div>
    </div>
</div>