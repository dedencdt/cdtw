<!-- Breadcumb -->
<div class="row">
    <div class="col">

        <nav aria-label="breadcrumb ">
            <ol class="breadcrumb bg-transparent">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">User</li>
            </ol>
        </nav>

    </div>

    <div class="col">
        <a href="<?= site_url() ?>user/add" class="btn btn-primary btn-icon-split float-right">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Tambah pengguna</span>
        </a>

    </div>
</div>

<!-- TABEL user -->
<div class="row">
    <div class="container-fluid">
        <div class="card p-2">
            <div class="card-header">
                <h2>Management data pengguna</h2>

            </div>
            <div class="card-body table-responsive">
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
                        <span>Results : <?= $total_rows ?></span>
                    </div>
                </div>
                <!-- BATAS PENCARIAN -->
                <?php if ($this->session->flashdata('success')) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= $this->session->flashdata('success'); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php $this->session->unset_userdata('success'); ?>
                <?php endif; ?>
                <table class="table table-hover table-responsive-stack" id="cdt-table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Username</th>
                            <th scope="col">Nama</th>
                            <th scope="col">No HP</th>
                            <th scope="col">Email</th>
                            <th scope="col">Rekening</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Role</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($row->result())) : ?>
                            <tr>
                                <td colspan="9">
                                    <div class="alert alert-danger" role="alert">
                                        Data tidak di temukan
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                        <?php
                        $no = 1;
                        foreach ($row->result() as $data) : ?>
                            <tr>
                                <td><?= ++$start ?></td>
                                <td><?= $data->username ?></td>
                                <td><?= $data->nama ?></td>
                                <td><?= $data->nohp ?></td>
                                <td><?= $data->email ?></td>
                                <td><?= $data->rekening ?></td>
                                <td><?= $data->alamat ?></td>
                                <td><?= ($data->role == 1 ? 'Admin' : ($data->role == 2 ? 'Member' : ($data->role == 3 ? 'CS' : ($data->role == 4 ? 'Vendor' : 'Packer')))) ?></td>
                                <td>

                                    <form action="<?= site_url() ?>user/del/<?= $data->user_id ?>" method="post">
                                        <a href="<?= site_url() ?>user/edit/<?= $data->user_id ?>" class="btn btn-sm btn-info">
                                            <i class="fa fa-fw fa-edit "></i>
                                            Edit
                                        </a>
                                        <input type="hidden" name="user_id" value="<?= $data->user_id ?>">
                                        <button type="submit" onclick="return confirm('Yakin ingin menghapus ?')" class="btn  btn-sm btn-danger">
                                            <i class="fa fa-fw fa-trash "></i>
                                            Hapus
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?= $this->pagination->create_links() ?>

            </div>
        </div>
    </div>
</div>