<!-- Breadcumb -->
<div class="row">
    <div class="col">

        <nav aria-label="breadcrumb ">
            <ol class="breadcrumb bg-transparent">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">RTS</li>
            </ol>
        </nav>

    </div>
</div>

<!-- TABEL user -->
<div class="row">
    <div class="container-fluid">
        <div class="card p-2">
            <div class="card-header">
                <h2>DATA RTS</h2>

            </div>
            <div class="card-body table-responsive">
                <?php if ($this->session->flashdata('success')) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= $this->session->flashdata('success'); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php
                    $this->session->unset_userdata('success'); ?>
                <?php endif; ?>

                <table class="table table-hover" id="dataTable">

                    <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Produk</th>
                            <th scope="col">Nama pelanggan</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">No Wa</th>
                            <th scope="col">Total</th>
                            <th scope="col">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($row as $data) :
                            $adrs = str_replace('~', ' ', $data->alamat);
                        ?>
                            <tr>
                                <td> <?= $no++ ?></td>
                                <td> <?= $data->nama_produk ?></td>
                                <td> <?= $data->penerima ?></td>
                                <td> <?= $adrs ?></td>
                                <td> <?= $data->nowa ?></td>
                                <td> <?= $data->total ?></td>
                                <td> <?= $data->created_at ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?= $this->pagination->create_links() ?>

            </div>
        </div>
    </div>
</div>