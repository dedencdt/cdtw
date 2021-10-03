<!-- Breadcumb -->
<div class="row">
    <div class="col">

        <nav aria-label="breadcrumb ">
            <ol class="breadcrumb bg-transparent">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Set Tanggal Gajian</li>
            </ol>
        </nav>

    </div>

    <div class="col">
        <button type="button" class="btn btn-primary btn-icon-split float-right" data-toggle="modal" data-target="#ModalSettanggal">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Set Tanggal</span>
        </button>

    </div>
</div>

<!-- TABEL user -->
<div class="row">
    <div class="container-fluid">
        <div class="card p-2">
            <div class="card-header">
                <h2>Data tanggal gajian</h2>
            </div>
            <div class="card-body table-responsive">
                <p>
                    <strong>Keterangan* : </strong> Rekapan komisi otomatis terekap selama H -7 dari tanggal tutup buku. <br>
                    <strong><em>Set tanggal</em></strong> di gunakan untuk menentukan tanggal gajian, dan secara otomatis tanggal rekap dan tutup buku terbuat <br>
                    <strong><em>Lihat Data Komisi</em></strong> Data Rekapan Komisi Yang harus di konfirmasi (direkap) oleh admin, Rekapan data dibuat secara otomatis oleh sistem.
                    <span class="badge badge-danger">Set tanggal / penambahan tanggal gajian Hanya boleh di lakukan pada Tanggal saat Rekap Data !!</span>


                </p>
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
                            <th scope="col">Tanggal Gajian</th>
                            <th scope="col">Tanggal Rekap</th>
                            <th scope="col">Tutup Buku</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($row->result() as $data) : ?>
                            <tr>
                                <td><?= ++$start ?></td>
                                <td><?= $data->tgl_gajian ?></td>
                                <td><?= $data->tgl_rekap ?></td>
                                <td><?= $data->tutup_buku ?></td>
                                <td>
                                    <div class="row">
                                        <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#ModalSettanggalId<?= $data->tglgajian_id ?>">
                                            <i class="fa fa-fw fa-edit "></i>
                                            Edit
                                        </button>

                                        <a href="<?= site_url() ?>komisi/delTgl/<?= $data->tglgajian_id ?>" onclick="return confirm('Yakin ingin menghapus ??')" class="btn btn-sm btn-danger">
                                            <i class="fa fa-fw fa-trash "></i>
                                            Delete
                                        </a>

                                        <div class="dropdown">
                                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fa fa-info-circle"></i> Lihat Data Komisi
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                <a class="dropdown-item" href="<?= site_url('komisi/salesmember/') ?><?= $data->tglgajian_id ?>">Rekap Komisi Members</a>
                                                <a class="dropdown-item" href="<?= site_url('komisi/salescs/') ?><?= $data->tglgajian_id ?>">Rekap Komisi CS</a>
                                                <a class="dropdown-item" href="<?= site_url('komisi/salesvendor/') ?><?= $data->tglgajian_id ?>">Rekap Komisi Vendor</a>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- Modal -->
                                    <div class="modal fade" id="ModalSettanggalId<?= $data->tglgajian_id ?>" tabindex="-1" role="dialog" aria-labelledby="ModalSettanggalId<?= $data->tglgajian_id ?>Label" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <form action="<?= site_url('komisi/process') ?>" method="post">

                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="ModalSettanggalId<?= $data->tglgajian_id ?>Label">Edit Tanggal</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <!-- Isi konten disini -->
                                                        <input type="hidden" name="tglgajian_id" value="<?= $data->tglgajian_id ?>">
                                                        <!-- hidden -->
                                                        <label for="tglgajian">Tanggal Gajian</label>
                                                        <input type="date" name="tglgajian" id="tglgajian" class="form-control" value="<?= $data->tgl_gajian ?>">
                                                        <label for="tglrekap">Rekap data <small> (H-1 tgl Gajian)</small></label>
                                                        <input type="date" name="tglrekap" id="tglrekap" class="form-control" value="<?= $data->tgl_rekap ?>">
                                                        <label for="tutupbuku">tutup Buku <small> (H-2 tgl Gajian)</small></label>
                                                        <input type="date" name="tutupbuku" id="tutupbuku" class="form-control" value="<?= $data->tutup_buku ?>">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary" name="editTgl">Save changes</button>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
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

<!-- Modal -->
<div class="modal fade" id="ModalSettanggal" tabindex="-1" role="dialog" aria-labelledby="ModalSettanggalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?= site_url('komisi/process') ?>" method="post">

                <div class="modal-header">
                    <h5 class="modal-title" id="ModalSettanggalLabel">Quick Set Tanggal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <!-- Isi konten disini -->
                    <input type="hidden" name="tglgajian_id" value="<?= 'cdt' . date('ymd') . random_string('alnum', 21) ?>">
                    <!-- hidden -->
                    <label for="tglgajian">Tanggal Gajian</label>
                    <input type="date" name="tglgajian" id="tglgajian" class="form-control">
                    <!-- <label for="tglrekap">Rekap data <small> (H-1 tgl Gajian)</small></label>
                    <input type="date" name="tglrekap" id="tglrekap" class="form-control">
                    <label for="tutupbuku">tutup Buku <small> (H-2 tgl Gajian)</small></label>
                    <input type="date" name="tutupbuku" id="tutupbuku" class="form-control"> -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="add">Save</button>
                </div>

            </form>
        </div>
    </div>
</div>