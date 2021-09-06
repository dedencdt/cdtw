<!-- Breadcumb -->
<div class="row">

    <div class="col">
        <nav aria-label="breadcrumb ">
            <ol class="breadcrumb bg-transparent">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= ucfirst($page) ?> apikey</li>
            </ol>
        </nav>
    </div>

    <div class="col">
        <a href="<?= site_url() ?>apikey" class="btn btn-warning btn-icon-split float-right">
            <span class="icon text-white-50">
                <i class="fas fa-undo"></i>
            </span>
            <span class="text">Kembali</span>
        </a>
    </div>
</div>

<div class="row">
    <div class="container-fluid">
        <div class="card p-2">
            <div class="card-header text-center">
                <?= ucfirst($page) ?> data
            </div>
            <div class="card-body">
                <div class="col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-6 offset-xl-3">
                    <!-- form -->
                    <form method="post" action="<?= site_url('api/process') ?>">
                        <!-- form hidden -->
                        <input type="hidden" name="apikey_id" id="apikey_id" value="<?= $row->apikey_id != '' ? $row->apikey_id : random_string('alnum', 10)  ?>">
                        <div class="form-group">
                            <label for="nama">Nama *</label>
                            <input type="text" class="form-control" name="nama" id="nama" value="<?= $row->nama ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="key">Key*</label>
                            <input type="text" class="form-control" name="key" id="key" value="<?= $row->key != '' ? $row->key : random_string('alnum', 10) ?>" required>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="submit" class="btn btn-primary btn-block " name="<?= $page ?>" value="Kirim" ">
                                    </div>
    
                                    <div class=" col">
                                <input type="reset" class="btn btn-warning btn-block" name="reset" value="Reset" ">
                                    </div>
                                </div>
                                <hr />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>