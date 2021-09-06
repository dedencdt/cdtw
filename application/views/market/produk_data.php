<!-- Breadcumb -->
<div class="row">
    <div class="col">

        <nav aria-label="breadcrumb ">
            <ol class="breadcrumb bg-transparent">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data produk</li>
            </ol>
        </nav>

    </div>

    <div class="col">
        <a href="<?= site_url() ?>produk/add" class="btn btn-primary btn-icon-split float-right">
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
                <h2>Management data Produk</h2>

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
                            <span>Results : <?= $total_rows = $total_rows  != 0 ? " <strong>  {$total_rows} </strong> " : '<strong class="alert alert-danger alert-dismissible fade show">Data tidak di temukan!! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></strong>' ?></span>
                        </div>
                    </div>
                    <!-- BATAS PENCARIAN -->

                    <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama produk</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Komisi</th>
                            <th scope="col">Vendor</th>
                            <th scope="col">stock</th>
                            <th scope="col">level</th>
                            <th scope="col">Desk</th>
                            <th scope="col">gambar</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($row->result() as $data) :  ?>
                            <tr>
                                <td><?= ++$start ?></td>
                                <td><?= $data->nama_produk ?></td>
                                <td><?= $data->harga ?></td>
                                <td><?= $data->komisi ?></td>
                                <td><?= $data->harga_vendor ?></td>
                                <td><?= $data->stock ?></td>
                                <td><?= $data->level ?></td>
                                <td><?= $data->desk ?></td>
                                <td>
                                    <img src="<?= $data->gambar ?>" alt="<?= $data->nama_produk ?>" class="img-thumbnail" width="100">
                                </td>
                                <td>
                                    <a href="<?= site_url() ?>produk/edit/<?= $data->produk_id ?>" class="btn btn-sm btn-info">
                                        <i class="fa fa-fw fa-edit "></i>
                                        Edit
                                    </a>
                                    <a href="<?= site_url() ?>produk/del/<?= $data->produk_id ?>" onclick="return confirm('Yakin ingin menghapus ??')" class="btn btn-sm btn-danger">
                                        <i class="fa fa-fw fa-trash "></i>
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <!-- pagination -->
                <?= $this->pagination->create_links() ?>

            </div>
        </div>
    </div>
</div>