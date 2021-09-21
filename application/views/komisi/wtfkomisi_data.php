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
                            <th scope="col">Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($row->result() as $data) :
                            $tgl = new DateTime($data->tgl_gajian);
                            $tglgajianstr = $tgl->format('D, d M Y');
                        ?>
                            <tr>
                                <td><?= ++$start ?></td>
                                <td><?= $tglgajianstr ?></td>
                                <td>
                                    <div class="row">
                                        <a href="<?= site_url('komisi/wtfmember/') ?><?= $data->tglgajian_id ?>" class="btn btn-info btn-sm">
                                            <i class="fa fa-user"></i> Komisi Member
                                        </a>
                                        <a href="<?= site_url('komisi/wtfcs/') ?><?= $data->tglgajian_id ?>" class="btn btn-primary btn-sm">
                                            <i class="fa fa-user"></i> Komisi CS
                                        </a>
                                        <a href="<?= site_url('komisi/wtfvendor/') ?><?= $data->tglgajian_id ?>" class="btn btn-secondary btn-sm">
                                            <i class="fa fa-user"></i> Komisi Vendor
                                        </a>
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