<table class="table table-hover" id="dataTable">
    <thead class="thead-light">
        <tr>
            <th scope="col">#</th>
            <th scope="col">No. Invoice</th>
            <th scope="col">Tanggal</th>
            <th scope="col">Total Komisi</th>
            <th scope="col">status</th>
            <th scope="col">Publisher</th>
            <th scope="col">Rekening</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        $member = $this->fungsi->printcs($row->tgl_gajian);
        foreach ($member->result() as $data) :
        ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $data->invoice ?></td>
                <td><?= date('d M Y', strtotime($row->tgl_gajian)) ?></td>
                <td><strong> Rp. <?= number_format($data->diterima) ?></strong></td>
                <td><span class="badge badge-<?= $data->status != 'menunggu' ? 'success' : 'danger' ?> p-2"><?= $data->status ?></span></td>
                <td><?= $data->username ?></td>
                <td><?= $data->rekening ?></td>

            </tr>
        <?php endforeach; ?>
    </tbody>
</table>