<!-- Breadcumb -->
<div class="row">

    <div class="col">
        <nav aria-label="breadcrumb ">
            <ol class="breadcrumb bg-transparent">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit data</li>
            </ol>
        </nav>
    </div>

</div>

<div class="row">
    <div class="container-fluid">
        <div class="card p-2">
            <div class="card-header text-center">
                Formulir Edit pengguna
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
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap" value="<?= $this->input->post('nama') ?? $row->nama ?>">
                                <!-- fORM ID HIDDEN -->
                                <input type="hidden" class="form-control" id="user_id" name="user_id" placeholder="user_id" value="<?= $row->user_id ?>">
                            </div>
                            <div class="form-group">
                                <label for="username">Username *</label>
                                <input type="hidden" class="form-control form-control-user" id="username" name="username" placeholder="Username.." value="<?= $this->input->post('username') ?? $row->username ?>" disabled>
                                <input type="text" class="form-control form-control-user" id="te" name="te" placeholder="Username.." value="<?= $this->input->post('username') ?? $row->username ?>" disabled>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label for="password">Password</label><small> (kosongkan jika tidak di ubah)</small>
                                    <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password" value="<?= $this->input->post('password') ?>"">
                                </div>
                                <div class=" col-sm-6">
                                    <label for="passconf">Konfirmasi Password *</label>
                                    <input type="password" class="form-control form-control-user" id="passconf" name="passconf" placeholder="Repeat Password" value="<?= $this->input->post('passconf') ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">Email *</label>
                                <input type="email" class="form-control form-control-user" id="email" name="email" placeholder="example@ex.com" value="<?= $this->input->post('email') ?? $row->email ?>" disabled>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="nohp">No HP / Whatsapp *</label>
                                <input type="number" class="form-control form-control-user" id="nohp" name="nohp" placeholder="No. HP / Whatsapp" value="<?= $this->input->post('nohp') ?? $row->nohp ?>">
                            </div>
                            <div class="form-group">
                                <label for="rekening">Rekening </label>
                                <input type="text" class="form-control form-control-user" id="rekening" name="rekening" placeholder="Rekening ex; BRI 09831312 An Nama.." value="<?= $this->input->post('rekening') ?? $row->rekening ?>">
                            </div>
                            <!-- <div class="form-group">
                                <label for="role">Role *</label>
                                <select class="form-control" name="role" id="role" disabled>
                                    <?php $role = $this->input->post('role') ?? $row->role ?>
                                    <option value="1" <?= $role == 1 ? 'selected' : null ?>>Admin</option>
                                    <option value="2" <?= $role == 2 ? 'selected' : null ?>>Member</option>
                                    <option value="3" <?= $role == 3 ? 'selected' : null ?>>Customer Sevice</option>
                                    <option value="4" <?= $role == 4 ? 'selected' : null ?>>Vendor</option>
                                    <option value="5" <?= $role == 5 ? 'selected' : null ?>>Packing</option>
                                </select>
                            </div> -->
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea class="form-control form-control-user" name="alamat" id="alamat" placeholder="Masukan alamat.."><?= $this->input->post('alamat') ?? $row->alamat ?></textarea>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <input type="submit" class="btn btn-primary btn-block " name="submit" value="Simpan" ">
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