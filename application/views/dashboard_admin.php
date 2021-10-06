<div class="row">
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb bg-transparent">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </nav>
</div>
<?php
// setting searchin
$datestart = '';
$dateend = '';

if (isset($_POST['interval'])) {
    $tgl = $this->input->post('daterange');
    $tgl =  explode(' - ', $tgl, 2);
    $tgl1 = explode('/', $tgl[0], 3);
    $tgl2 = explode('/', $tgl[1], 3);

    $datestart = $tgl1[2] . '-' . $tgl1[0] . '-' . $tgl1[1]; //. ' 00:01:01';
    $dateend = $tgl2[2] . '-' . $tgl2[0] . '-' . $tgl2[1]; //. ' 00:00:00';
    // echo $datestart . ' dan ' . $dateend;
} else {
    $datestart = date('Y-m-d'); //. ' 00:01:01';
    $dateend = date('Y-m-d'); //. ' 00:00:00';
    // echo $datestart . ' to ' . $dateend;
}

?>
<div class="row">

    <div class="container-fluid">
        <!-- Content Row -->
        <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    User</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $this->fungsi->count_alluser() ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    User Aktif</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $this->fungsi->count_userAktif() ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-check fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- dashboard member -->
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Produk</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $this->fungsi->count_allProduk() ?> </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-boxes fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- dashboard member -->
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Semua Pesanan</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $this->fungsi->count_allOrderan() ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- dashboard member -->
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Proses COD</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= number_format($this->fungsi->count_allOrderanCodRp()) ?> ( <?= $this->fungsi->count_allOrderanCod() ?> ) </div>
                                <span><em>harga + ongkir</em></span>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-truck fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Pesanan Selesai</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= number_format($this->fungsi->count_alldoneRp()) ?> ( <?= number_format($this->fungsi->count_alldone()) ?> )</div>
                                <span><em>harga + ongkir</em></span>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-tasks fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Komisi sudah DIBAYAR</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= number_format($this->fungsi->count_allkomisipaid($this->fungsi->user_login()->user_id)) ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-hand-holding-usd fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Net Bersih ( Estimasi )</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= number_format($this->fungsi->count_alldoneRp() - $this->fungsi->count_allkomisipaid()) ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-money-check-alt fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- Content Row -->

    </div>
</div>

<!-- filter Report -->
<div class="row mt-4">
    <div class="container-fluid">
        <div class="col-md">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md">

                            <div class="col-md-1 float-left">
                                <span class="">Filter : </span>
                            </div>

                            <div class="col-md-2 float-left">
                                <!-- DATE PICKER -->
                                <form action="" method="post" id="form-datepicker">
                                    <div class="input-group mb-3">
                                        <input type="text" name="daterange" id="cdt-daterange" value="" format="Y-m-d" class="form-control" />
                                        <div class="input-group-append">
                                            <span class="input-group-text" id=""><button type="submit" name="interval" style="border: none; padding:0;" form="form-datepicker"><i class="fa fa-search"></i></button></span>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- tracking -->


<!-- TABEL SALES -->
<div class="row mt-4">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <table class="table table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Sales</th>
                            <th scope="col">Pendapatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $tblKomisiadmin = $this->fungsi->count_tblsalesadmin($datestart, $dateend);
                        if ($tblKomisiadmin != null) :
                            foreach ($tblKomisiadmin as $adminkom) : ?>
                                <tr>
                                    <td><?= $adminkom->updated ?></td>
                                    <td><?= $adminkom->qty ?></td>
                                    <td>Rp. <?= number_format($adminkom->total_komisi) ?></td>
                                </tr>
                            <?php endforeach;
                        else :
                            ?>
                            <tr>
                                <td><?= date('Y-m-d') ?></td>
                                <td>0</td>
                                <td>0</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- TABEL cod -->
<div class="row mt-4">
    <div class="container-fluid">

        <div class="card">
            <div class="card-body">

                <table class="table table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Tanggal</th>
                            <th scope="col">COD</th>
                            <th scope="col">Pendapatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $tblcodadmin = $this->fungsi->count_tblcodadmin($datestart, $dateend);
                        if ($tblcodadmin != null) :
                            foreach ($tblcodadmin as $dcodcs) : ?>
                                <tr>
                                    <td><?= $dcodcs->updated ?></td>
                                    <td><?= $dcodcs->qty ?></td>
                                    <td>Rp. <?= number_format($dcodcs->total_komisi) ?></td>
                                </tr>
                            <?php endforeach;
                        else :
                            ?>
                            <tr>
                                <td><?= date('Y-m-d') ?></td>
                                <td>0</td>
                                <td>0</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        $('input[name="daterange"]').daterangepicker({
            opens: 'left'
        }, function(start, end, label) {
            $('#cdt-daterange').val(start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
            console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        });
    });
</script>