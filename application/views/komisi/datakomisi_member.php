<!-- Breadcumb -->
<div class="row">
    <div class="col">

        <nav aria-label="breadcrumb ">
            <ol class="breadcrumb bg-transparent">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Komisi Member</li>
            </ol>
        </nav>

    </div>

</div>



<!-- TABEL user -->
<div class="row">
    <div class="container-fluid">
        <div class="card p-2">
            <div class="card-header">
                <h2>List Data Komisi Member</h2>

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
                            <th scope="col">No. Invoice</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Komisi Sales</th>
                            <th scope="col">RTS</th>
                            <th scope="col">Lain Lain</th>
                            <th scope="col">Total Komisi</th>
                            <th scope="col">status</th>
                            <th scope="col">note</th>
                            <th scope="col">Publisher</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($row->result() as $data) : ?>
                            <tr>
                                <td><?= ++$start ?></td>
                                <td><?= $data->invoice ?></td>
                                <td><?= $data->tgl_gajian ?></td>
                                <td>Rp. <?= number_format($data->komisisales) ?></td>
                                <td>Rp. <?= number_format($data->rts) ?></td>
                                <td>Rp. <?= number_format($data->lainlain) ?></td>
                                <td>Rp. <strong class="<?= $data->diterima < 0 ? 'text-danger' : null ?>"><?= number_format($data->diterima) ?></strong></td>
                                <td><span class="badge badge-<?= $data->status == 'menunggu' ? 'danger' : 'success' ?>"><?= $data->status ?></span></td>
                                <td><?= $data->note ?></td>
                                <td><?= $data->username ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?= $this->pagination->create_links() ?>

            </div>
        </div>
    </div>
</div>

<!-- <script>
    $(document).ready(function() {
        $('.cin-komisi, .cin-rts, .cin-lainlain').keyup(function() {
            let komisi = $('.cin-komisi').val();
            let rts = $('.cin-rts').val();
            let lainlain = $('.cin-lainlain').val();
            let total = komisi - rts - lainlain;

            $('.cin-diterima').val(total);
        });
    });
</script> -->