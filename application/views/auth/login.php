<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Codtech - Login</title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/') ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/') ?>css/sb-admin-2.min.css" rel="stylesheet">


</head>

<body class="bg-gradient-300">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-md-10 col-lg-6">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <img src="<?= site_url('assets/img/') ?>logo-codtech.png" style="width:50%; margin:auto; padding-top:50px" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">
                        </div>
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <!-- Form Start -->
                                    <form class="user" action="<?= site_url('auth/process') ?>" method="post">
                                        <!-- Session alert -->
                                        <?php if ($this->session->flashdata('success')) : ?>
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <?= $this->session->flashdata('success'); ?>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <?php $this->session->unset_userdata('success'); ?>
                                        <?php endif; ?>

                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" name="username" id="username" placeholder="Masukan username.." autocomplete="off" autofocus required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" name="password" id="password" placeholder="Password.." required>
                                        </div>
                                        <input type="submit" name="login" class="btn btn-user btn-block btn-login" style="background-color:#ff7400; color:white;" value="Login" />

                                    </form>
                                    <hr>
                                    <!-- <div class="text-center">
                                        <a class="small" href="#">Forgot Password?</a>
                                    </div> -->
                                    <div class="text-center">
                                        <a class="btn btn-transparant" href="<?= site_url('auth/registration') ?>">Create an Account!</a>
                                        <!-- <button type="button" class="btn btn-transparant" data-toggle="modal" data-target="#ModalRegis">Create an Account!</button> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
    <!-- Modal -->
    <div class="modal fade" id="ModalRegis" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pendaftaran Member</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="reff">Kode Refferal</label>
                    <input class="form-control" type="text" id="kode_leader" name="kode_leader" placeholder="Masukan Kode Refferal Leader Anda." required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="checkRefferal()">Next</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url('assets/') ?>vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url('assets/') ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url('assets/') ?>vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url('assets/') ?>js/sb-admin-2.min.js"></script>




</body>

</html>