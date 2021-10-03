<div class="row">
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb bg-transparent">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </nav>
</div>

<div class="row">

    <div class="container-fluid">
        <!-- Content Row -->
        <div class="row">

            <!-- dashboard member -->
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    LEAD</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($this->fungsi->count_prosescodm($this->fungsi->user_login()->user_id)) ?> Lead</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    CLOSING ORDER</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($this->fungsi->count_siapcairm($this->fungsi->user_login()->user_id)) ?> Closing order</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-check fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                    RTS</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($this->fungsi->count_rtsm($this->fungsi->user_login()->user_id)) ?> di Return</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-undo fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    SIAP CAIR</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= number_format($this->fungsi->count_menungguttfm($this->fungsi->user_login()->user_id)) ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-money-dollar fa-2x text-gray-300"></i>
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
                                    MENUNGGU TF</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= number_format($this->fungsi->count_totalkomisi($this->fungsi->user_login()->user_id)) ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-gray-300"></i>
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
                                    Komisi sudah Cair</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= number_format($this->fungsi->count_totalkomisi($this->fungsi->user_login()->user_id)) ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-gray-300"></i>
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
                                <!-- Setting Searching -->
                                <?php
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- tracking -->

<div class="row mt-4">
    <div class="container-fluid">
        <div class="col-md-6 float-sm-left p-1">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <!-- TRACKER VISIT -->
                        <div class="col-lg-6 col-xl-6">
                            <ul class="list-unstyled">
                                <?php if ($this->fungsi->count_visit($this->fungsi->user_login()->user_id, 'prelander', $datestart, $dateend) > 0) : ?>
                                    <li><i class="far fa-circle text-success"></i> Prelander<span class="float-right"><?= $this->fungsi->count_visit($this->fungsi->user_login()->user_id, 'prelander', $datestart, $dateend) ?></span></li>
                                <?php endif; ?>
                                <li><i class="far fa-circle text-success"></i> Visit <span class="float-right"><?= $this->fungsi->count_visit($this->fungsi->user_login()->user_id, 'landingpage', $datestart, $dateend) ?></span></li>
                                <li><i class="far fa-circle text-success"></i> Form View <span class="float-right"><?= $this->fungsi->count_visit($this->fungsi->user_login()->user_id, 'formorder', $datestart, $dateend) ?></span></li>
                                <li><i class="far fa-circle text-info"></i> Lead <span class="float-right"><?= $this->fungsi->count_visit($this->fungsi->user_login()->user_id, 'lead', $datestart, $dateend) ?></span></li>
                                <li><i class="far fa-circle text-primary"></i> Closing COD <span class="float-right"><?= $this->fungsi->count_static($this->fungsi->user_login()->user_id, 'packing', $datestart, $dateend) ?></span></li>
                            </ul>
                        </div>
                        <!-- ORDER TRACK -->
                        <div class="col-lg-6 col-xl-6">
                            <ul class="list-unstyled">
                                <li><i class="far fa-circle text-success"></i> Sales<span class="float-right"><?= $this->fungsi->count_static($this->fungsi->user_login()->user_id, 'completed', $datestart, $dateend) ?></span></li>
                                <li><i class="far fa-circle text-danger"></i> RTS <span class="float-right"><?= $this->fungsi->count_static($this->fungsi->user_login()->user_id, 'refunded', $datestart, $dateend) ?></span></li>
                                <li><i class="far fa-circle text-warning"></i> Cancel <span class="float-right"><?= $this->fungsi->count_static($this->fungsi->user_login()->user_id, 'cencelled', $datestart, $dateend) ?></span></li>
                                <li><i class="far fa-circle text-warning"></i> Junk <span class="float-right"><?= $this->fungsi->count_static($this->fungsi->user_login()->user_id, 'junk', $datestart, $dateend) ?></span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        // ===========
        // for rete

        $leadmember = $this->fungsi->count_visit($this->fungsi->user_login()->user_id, 'lead', $datestart, $dateend);
        $codmember = $this->fungsi->count_static($this->fungsi->user_login()->user_id, 'delivery', $datestart, $dateend);
        $packingmember = $this->fungsi->count_static($this->fungsi->user_login()->user_id, 'packing', $datestart, $dateend);
        $closingmember = $this->fungsi->count_static($this->fungsi->user_login()->user_id, 'completed', $datestart, $dateend);

        $leadm = $leadmember != null ? $leadmember : 0;
        $codm = $codmember != null ? $codmember : 0;
        $packingm = $packingmember != null ? $packingmember : 0;
        $closingm = $closingmember != null ? $closingmember : 0;


        // ==============
        // Genrate codrate
        if ($codm > 0 || $leadm > 0 || $packingm > 0) {

            $codrate = ($codm + $packingm) * round((100 / $leadm));
        } else {
            $codrate = 0;
        }

        // ==============
        // Genrate CLOSING RATE
        if ($closingm > 0 || $leadm > 0) {

            $closingrate = $closingm * round((100 / $leadm));
        } else {
            $closingrate = 0;
        }

        $rtsmember = $this->fungsi->count_static($this->fungsi->user_login()->user_id, 'refunded', $datestart, $dateend);
        $rtsm = $rtsmember != null ? $rtsmember : 0;
        // =========
        // RTS Rate
        if ($rtsm > 0 || $leadm > 0) {
            $rtsrate = $rtsm * round((100 / $leadm));
        } else {
            $rtsrate = 0;
        }

        ?>

        <div class="col-md-6  col-lg-3 float-sm-left p-1">
            <div class="card bg-secondary">
                <div class="card-body">
                    <div class="card-body">
                        <h4 class="small font-weight-bold text-gray-100">RTS Rate<span class="float-right"><?= $rtsrate ?>%</span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: <?= $rtsrate ?>%" aria-valuenow="<?= $rtsrate ?>" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3 float-sm-left p-1">
            <div class="card bg-info">
                <div class="card-body">
                    <div class="text-xs text-gray-100 font-weight-bold text-info text-uppercase mb-1">COD RATE
                    </div>
                    <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-100"><?= $codrate  ?>%</div>
                        </div>
                        <div class="col">
                            <div class="progress progress-sm mr-2">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: <?= $codrate  ?>%" aria-valuenow="<?= $codrate  ?>" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <div class="col-md-6 col-lg-3 float-sm-left p-1">
            <div class="card bg-success">
                <div class="card-body">
                    <div class="text-xs text-gray-100 font-weight-bold text-info text-uppercase mb-1">CLOSING RATE
                    </div>
                    <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-100"><?= $closingrate  ?>%</div>
                        </div>
                        <div class="col">
                            <div class="progress progress-sm mr-2">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: <?= $closingrate  ?>%" aria-valuenow="<?= $closingrate  ?>" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>


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
                            <th scope="col">Komisi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $tblKomisimember = $this->fungsi->count_tblsalesm($this->fungsi->user_login()->user_id, $datestart, $dateend);
                        if ($tblKomisimember != null) :
                            foreach ($tblKomisimember as $dkomisimember) : ?>
                                <tr>
                                    <td><?= $dkomisimember->updated ?></td>
                                    <td><?= $dkomisimember->qty ?></td>
                                    <td>Rp. <?= number_format($dkomisimember->total_komisi) ?></td>
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
                            <th scope="col">Komisi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $tblcodmember = $this->fungsi->count_tblcodm($this->fungsi->user_login()->user_id, $datestart, $dateend);
                        if ($tblcodmember != null) :
                            foreach ($tblcodmember as $dcodm) : ?>
                                <tr>
                                    <td><?= $dcodm->updated ?></td>
                                    <td><?= $dcodm->qty ?></td>
                                    <td>Rp. <?= number_format($dcodm->total_komisi) ?></td>
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