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
            <?php if ($this->fungsi->user_login()->role == 2) : ?>
                <?php $this->view('template/dashboard/member/member_dashboard') ?>
            <?php endif; ?>

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
        <div class="col-md-6  col-lg-3 float-sm-left p-1">
            <div class="card bg-success">
                <div class="card-body">
                    <div class="card-body">
                        <h4 class="small font-weight-bold text-gray-100">Closing Rate<span class="float-right">40%</span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3 float-sm-left p-1">
            <div class="card bg-info">
                <div class="card-body">
                    <div class="text-xs text-gray-100 font-weight-bold text-info text-uppercase mb-1">BIAYA GAGAL KIRIM ( RTS )
                    </div>
                    <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-100">80%</div>
                        </div>
                        <div class="col">
                            <div class="progress progress-sm mr-2">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                    <!-- <h4 class="small font-weight-bold text-gray-100">RTS Rates <span class="float-right">20%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                    </div> -->
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
                        <tr>
                            <td>2021-03-1</td>
                            <td>10</td>
                            <td>Rp. 3,200,000</td>
                        </tr>
                        <tr>
                            <td>2020-03-2</td>
                            <td>3</td>
                            <td>Rp. 400,000</td>
                        </tr>

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
                        <tr>
                            <td>2021-03-1</td>
                            <td>10</td>
                            <td>Rp. 3,200,000</td>
                        </tr>
                        <tr>
                            <td>2020-03-2</td>
                            <td>3</td>
                            <td>Rp. 400,000</td>
                        </tr>

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