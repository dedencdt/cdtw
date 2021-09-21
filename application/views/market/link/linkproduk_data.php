<!-- Breadcumb -->
<div class="row">
    <div class="col">

        <nav aria-label="breadcrumb ">
            <ol class="breadcrumb bg-transparent">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data linkproduk</li>
            </ol>
        </nav>

    </div>

    <div class="col">
        <a href="<?= site_url() ?>linkproduk/add" class="btn btn-primary btn-icon-split float-right">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Tambah Poduk</span>
        </a>

    </div>
</div>

<!-- TABEL user -->
<div class="row">
    <div class="container-fluid">
        <div class="card p-2">
            <div class="card-header">
                <h2>Management data linkproduk</h2>

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
                            <th scope="col">Nama Produk</th>
                            <th scope="col">Label</th>
                            <th scope="col">Landing page</th>
                            <th scope="col">Form order</th>
                            <th scope="col">Prelander</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($row->result() as $data) :
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $data->nama_produk ?></td>
                                <td><?= $data->label ?></td>
                                <td><?= $data->vc ?></td>
                                <td><?= $data->atc ?></td>
                                <td><?= $data->prelander ?></td>
                                <td>
                                    <a href="<?= site_url() ?>linkproduk/edit/<?= $data->linkproduk_id ?>" class="btn btn-sm btn-info">
                                        <i class="fa fa-fw fa-edit "></i>
                                        Edit
                                    </a>
                                    <a href="<?= site_url() ?>linkproduk/del/<?= $data->linkproduk_id ?>" onclick="return confirm('Yakin ingin menghapus ??')" class="btn btn-sm btn-danger">
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