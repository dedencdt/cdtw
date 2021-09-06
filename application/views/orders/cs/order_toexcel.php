<table border="1px">
    <tr>
        <th>Nama Penerima</th>
        <th>Alamat Penerima</th>
        <th>Nomor Telepon</th>
        <th>Kode Pos</th>
        <th>Berat</th>
        <th>Harga Barang (Jika NON-COD)</th>
        <th>Nilai COD (Jika COD)</th>
        <th>Isi Paketan (Nama Produk)</th>
        <th>*Kelurahan</th>
        <th>**Quantity</th>
        <th>*Instruksi Pengiriman</th>
    </tr>
    <?php foreach ($row as $data) :
        $alamat =  explode('~', $data->alamat);
        $jln = $alamat[0];
        $add1 = explode(',', $alamat[1]);
        $kelurahan =  $add1[0];
        $kecamatan = $add1[1];
        $kota = $alamat[2];
        $prov = $alamat[3];
        $kodepos = $alamat[4];
    ?>
        <tr>
            <td><?= $data->penerima ?></td>
            <td><?= $jln ?></td>
            <td>'<?= $data->nowa ?></td>
            <td><?= $kodepos ?></td>
            <td>1</td>
            <td></td>
            <td><?= $data->total ?></td>
            <td><?= $data->nama_produk ?></td>
            <td><?= $kelurahan ?></td>
            <td>1</td>
            <td></td>
        </tr>
    <?php endforeach; ?>
</table>