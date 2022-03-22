<?xml version="1.0" encoding="UTF-8" ?>
<html xmlns='http://www.w3.org/1999/xhtml' xmlns:b='http://www.google.com/2005/gml/b' xmlns:data='http://www.google.com/2005/gml/data' xmlns:expr='http://www.google.com/2005/gml/expr'>
<head>
    <title><?= $row->nama_produk ?></title>
  <b:include data='blog' name='all-head-content'/>

<meta content='https://cdn.hellosehat.com/wp-content/uploads/2016/08/buah-apel.jpg' property='og:image'/>
<meta content='Mengkonsumsi buah buahan dan sayuran sangat bermanfaat bagi kesehatan tubuh karena bnyak mengandung vitamin, mineral, serat, dan antioksidan .' property='og:description'/>
  <b:skin><![CDATA[
                  
                  /****CSS CODE*****/
                  
                  ]]></b:skin>
  
   <!-- CSS BOOTSTRAP -->
    <link crossorigin='anonymous' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' integrity='sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm' rel='stylesheet'/>
    <!-- FA -->
    <link crossorigin='anonymous' href='https://pro.fontawesome.com/releases/v5.10.0/css/all.css' integrity='sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p' rel='stylesheet'/>

    <style>
        .cdt-mobilecontent {
            background-color: rgb(166, 196, 204);
            width: 100%;
            height: 100%;
      	padding-top: 20%;
        }
    </style>
    <script>

    </script>

</head>
<body onload='sendJson()'>
  
  <b:section class='hello' id='hello'/>

      <script id='fbx'/>

    <div class='cdt-hidden cdt-keyword' style='display: none;'>
   
        <div class='cdt-address'>
            <center><span class='text-white'>Jl Sumbon 2 Ds. Kedokangabus - Kec gabuswetan - Indramayu 45263</span></center>
        </div>
    </div>
    <!-- web konten -->
    <div class='cdt-webcontent'>
        <!-- enwebcontent -->
    </div>
    <!-- end webconten -->

    <!-- mobile content -->
    <div class='cdt-mobilecontent'>
        <!-- masukan content android disini -->
    </div>

    <!-- JQ BOOTSTRAP -->
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js'/>
    <script crossorigin='anonymous' integrity='sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q' src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js'/>
    <script crossorigin='anonymous' integrity='sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl' src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js'/>
    <script crossorigin='anonymous' integrity='sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl' src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js'/>
    <script src='https://codtech.id/js/cdtPLV1_tOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfE.js'/>
    <script>
        // Variabel
        let isMobile = /iPhone|iPad|iPod|Android|Mobi/i.test(navigator.userAgent);
        let webContent = document.querySelector(".cdt-webcontent");
        let mobileContent = document.querySelector(".cdt-mobilecontent");
        let addressOrigin = window.location.origin;


        // Dynamic data of website
        let frameid = '<?= $row->frame_id ?>';
        let dataurl = window.location.href.toString();
        let dataip = 'shopify';
        let data = {
            'label': 'prelander',
            'url': dataurl,
            'ip_address': dataip,
            'frame_id': frameid
        };

         // Dynamic data of server
        let pLpLink = '<?= $row->vc ?>?reff_cdt=<?= $row->frame_id ?>';
        let pAtc = '<?= $row->atc ?>?reff_cdt=<?= $row->frame_id ?>';
        let pTitle = '<?= $row->nama_produk ?>';
        let pDesk = '<?= $row->desk ?>';
        let pPrice = '<?= number_format($row->harga) ?>';
    </script>
    <!-- LOGICAL -->
    <script src='https://codtech.id/js/cdtPLV100_ScQsAAPkeEzDLFoR43cG1P.js'/>


</body>
</html>