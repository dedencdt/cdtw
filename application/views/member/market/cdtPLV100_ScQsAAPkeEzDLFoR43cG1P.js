

        // logika
        if (isMobile) { // if Mobile
            webContent.setAttribute("style", "display:none");
            $('.cdt-mobilecontent').html(`<div class="container-fluid d-flex justify-content-center">
            <div class="row">
                <div class="col">
                    <h3 class="text-white pt-5 text-center">Apakah Jenis kelamin anda ??</h3>
                    <center>
                        <div class="cdt-btn">
                            <a class="btn btn-primary cdt-nextlink">Perempuan</a>
                            <a class="btn btn-danger cdt-nextlink">Laki Laki</a>
                        </div>
                    </center>
                </div>
            </div>
        </div>`);
        } else { // if web
            mobileContent.setAttribute("style", "display:none");
            $('.cdt-webcontent').html(`<div class=" container">
        <div class="row">
            <div class="col pb-4 pt-5">
                <h1 class="text-center display-3"> <span class="badge badge-secondary title-web">ONLINE STORE</span></h1>
            </div>
            <hr />
        </div>
        <div class="row">
            <div class="col-6">
                <div class="col-12">
                    <img src="https://www.ubuy.co.id/skin/frontend/default/ubuycom/images/empty_cart.jpg" class="rounded mx-auto d-block" width="80%%" alt="...">
                </div>
            </div>
            <div class="col-6">
                <div class="jumbotron">
                    <h2 class="display-6 cdt-productname"></h2>
                    <div class="row">
                        <div class="pl-3">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <span><em>741,342 x dilihat</em></span>
                        </div>
                    </div>
                    <p class="lead cdt-desc"></p>
                    <p class="lead">

                        Produk ini bisa langsung diorder dengan cara : <br>
                        – klik ‘beli sekarang’
                        <br>
                        NOTE :
                        <br>
                        – Bisa COD <br>
                    </p>
                    <hr class="my-4">
                    <h4 class="cdt-price">Rp. </h4>
                    <p class="lead">
                        <a class="btn btn-primary btn-lg cdt-formlink" role="button">Beli Sekarang</a>
                    </p>
                </div>
            </div>
        </div>`);
        }

        // EKSEKUSI
        $('.cdt-nextlink').attr('href', pLpLink);
        $('.cdt-formlink').attr('href', pAtc);
        $('.cdt-productname').text(pTitle);
        $('.cdt-desc').text(pDesk);
        $('.cdt-price').text(pPrice);