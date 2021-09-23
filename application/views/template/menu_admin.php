<div class="sidebar-heading">
    Modul Admin
</div>
<!-- Menu member- Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#dropdonKomisi" aria-expanded="true" aria-controls="dropdonKomisi">
        <i class="fas fa-fw fa-money-bill-wave"></i>
        <span>Manage Komisi</span>
    </a>
    <div id="dropdonKomisi" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Modul Komisi:</h6>
            <a class="collapse-item" href="<?= site_url('komisi/settanggal') ?>">Setting Tanggal gaji</a>
            <a class="collapse-item" href="<?= site_url('komisi/waitingtotf') ?>">Menunggu TF</a>
            <a class="collapse-item" href="<?= site_url('komisi/datamember') ?>">Komisi Member</a>
            <a class="collapse-item" href="<?= site_url('komisi/datacs') ?>">Komisi CS</a>
            <a class="collapse-item" href="<?= site_url('komisi/datavendor') ?>">Komisi Vendor</a>
        </div>
    </div>
</li>

<!-- Menu member- Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#dropdonKonfPay" aria-expanded="true" aria-controls="dropdonKonfPay">
        <i class="fas fa-fw fa-check"></i>
        <span>Konf Pembayaran</span>
    </a>
    <div id="dropdonKonfPay" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Modul Payment:</h6>
            <a class="collapse-item" href="<?= site_url('') ?>">Data Pembayaran</a>
            <a class="collapse-item" href="<?= site_url('') ?>">Data Rekening</a>
        </div>
    </div>
</li>

<!-- Menu member- Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#dropdonwOrder" aria-expanded="true" aria-controls="dropdonwOrder">
        <i class="fas fa-fw fa-users-cog"></i>
        <span>Orders</span>
    </a>
    <div id="dropdonwOrder" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Modul Order:</h6>
            <a class="collapse-item" href="<?= site_url('manage/checkorder') ?>">Data Order</a>
        </div>
    </div>
</li>


<!-- Menu member- Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-users-cog"></i>
        <span>Member</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Modul member:</h6>
            <a class="collapse-item" href="<?= site_url('user') ?>">Semua Member</a>
            <a class="collapse-item" href="<?= site_url('api') ?>">Setting Api key</a>
            <a class="collapse-item" href="<?= site_url('api/docs') ?>">Docs REST API</a>
        </div>
    </div>
</li>

<!-- Menu member- Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#dropdownLangganan" aria-expanded="true" aria-controls="dropdownLangganan">
        <i class="fas fa-fw fa-clock"></i>
        <span>Langganan</span>
    </a>
    <div id="dropdownLangganan" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Modul Langganan:</h6>
            <a class="collapse-item" href="<?= site_url('langganan') ?>">Data langganan</a>
            <a class="collapse-item" href="<?= site_url('expdate') ?>">Setting Harga</a>
        </div>
    </div>
</li>

<!-- Menu Market- Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#dropdownmarket" aria-expanded="true" aria-controls="dropdownmarket">
        <i class="fas fa-fw fa-box"></i>
        <span>Produk</span>
    </a>
    <div id="dropdownmarket" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Modul Market:</h6>
            <a class="collapse-item" href="<?= site_url('produk') ?>">Data produk</a>
            <a class="collapse-item" href="<?= site_url('linkproduk') ?>">Setting link</a>
        </div>
    </div>
</li>

<!-- Menu Vvendor -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseVendor" aria-expanded="true" aria-controls="collapseVendor">
        <i class="fas fa-fw fa-store"></i>
        <span>Vendor</span>
    </a>
    <div id="collapseVendor" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Modul Vendor:</h6>
            <a class="collapse-item" href="<?= site_url('vendor/data') ?>">Semua Vendor</a>
            <a class="collapse-item" href="<?= site_url('vendor/add') ?>">Tambah Vendor</a>
        </div>
    </div>
</li>