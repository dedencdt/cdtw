<?php echo '<?xml version="1.0" encoding="UTF-8" ?>' ?>
<html xmlns='http://www.w3.org/1999/xhtml' xmlns:b='http://www.google.com/2005/gml/b' xmlns:data='http://www.google.com/2005/gml/data' xmlns:expr='http://www.google.com/2005/gml/expr'>

<head>
  <!-- Required meta tags -->
  <title></title>
  <b:include data='blog' name='all-head-content' />
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta property="og:title" content="Parfume Wangi" />
  <meta property="og:description" content="Parfum wanita terbaik yang wanginya tahan lama bisa kamu temukan dengan berbagai variasi wangi dan harga" />
  <meta property="og:image" content="https://codtech.id/wp-content/uploads/2022/02/Parum-ozawa.jpg" />
  <b:skin>
    <![CDATA[
                  
                  /****CSS CODE*****/
                  
                  ]]>
  </b:skin>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous" />
</head>

<body onload="sendJson()">
  <b:section class='hello' id='hello' />
  <div class="fbpx"></div>
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="cdt-konten">
          <h1></h1>
          <a href="" class="btn btn-danger btn-lg cdt-next"></a>

          <div class="cdt-hidden">
            <div class="kmember"></div>

            <div class="masukinDiSini">
              <!--  ADS COPY -->


              <!--BATAS  ADS COPY -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous" />
  <script src='https://codtech.id/js/cdtPLV1_tOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfE.js' />

  <script>
    // Dynamic data of website
    let frameid = '<?= $row->frame_id ?>';
    let dataurl = window.location.href.toString();
    let dataip = 'blogspot';
    let data = {
      'label': 'prelander',
      'url': dataurl,
      'ip_address': dataip,
      'frame_id': frameid
    };


    // SETT DATA PRELANDER
    let titleWeb = '<?= $row->nama_produk ?>' + ' | ';
    let linkStep = '<?= $row->prelander ?>?reff_cdt=' + frameid;
  </script>
  <script src="https://codtech.id/js/cdtXMLBLV002.js" />
</body>

</html>