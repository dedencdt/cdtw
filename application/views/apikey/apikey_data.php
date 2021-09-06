<!-- Breadcumb -->
<div class="row">
    <div class="col">

        <nav aria-label="breadcrumb ">
            <ol class="breadcrumb bg-transparent">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data apikey</li>
            </ol>
        </nav>

    </div>

    <div class="col">
        <a href="<?= site_url() ?>api/add" class="btn btn-primary btn-icon-split float-right">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Tambah api</span>
        </a>

    </div>
</div>

<!-- INFO CARD -->
<div class="row mb-4">
    <div class="container-fluid">
        <div class="card bg-info text-gray-100">
            <div class="card-body">
                <h5 class="card-title">DOCUMENTATION</h5>
                <p class="card-text">
                    POST / GET /
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
                <h2>Management data apikey</h2>

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
                            <th scope="col">Nama apikey</th>
                            <th scope="col">Key</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($row->result() as $data) :
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $data->nama ?></td>
                                <td><?= $data->key ?></td>
                                <td>
                                    <a href="<?= site_url() ?>api/edit/<?= $data->apikey_id ?>" class="btn btn-sm btn-info">
                                        <i class="fa fa-fw fa-edit "></i>
                                        Edit
                                    </a>
                                    <a href="<?= site_url() ?>api/del/<?= $data->apikey_id ?>" onclick="return confirm('Yakin ingin menghapus ??')" class="btn btn-sm btn-danger">
                                        <i class="fa fa-fw fa-trash "></i>
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>