<div class="row">
    <div class="col">
        <div class="card">
            <h5 class="card-header">REST CLIENT</h5>
            <div class="card-body">
                <h5 class="card-title">ENDPOINT API </h5>
                <p>
                    POST <span class="bg-info p-1 text-gray-100">/api/sendtracking/frameid(automatis)</span>
                </p>
                <p>
                    GET DATA MENGGUNAKAN CURL PHP & AJAX JQ
                </p>
                <pre>
// PAstikan waktu sesuai Timezone
date_default_timezone_set('asia/jakarta');

=======================
//CURL PHP
=======================

CURL 
Intruksi setting : Untuk pertama kali settig silahkan masuk kedalam Plugin, cari di plugin ccodtech utility car file cdt-curl.php
file source : codtech.id/wp-content/plugins/codtech-utility/ 
kemudian sesuaikan rest url atau endpoint  

// Membuat fungsi cURL
function request_api($method, $endpoint, $data = null)
{

    $resturl = 'http://localhost/cdtmember'; // Masukan URL REST Server home tanpa di akhiri '/'
    $urlapi = $resturl . $endpoint;
    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => $urlapi,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_TIMEOUT => 0,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_CUSTOMREQUEST => $method
    ]);
    if ($method == 'POST' || $method == 'PUT') {
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
    }

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        return "cURL Error #:" . $err;
    } else {
        return $response;
    }
}
    //========================
   // Data sisi Client => Pasang di setiap Landing page

 $key = [
        'key' => $datas['key'] // Key REST API
    ];
    $frame_id = isset($_GET['reff_cdt']) ? $_GET['reff_cdt'] : null;
    $params = http_build_query($key);

    $endpoint = '/api/sendtracking/'; // Endpoint Api => /api/sendtracking/
    $apiurl = $endpoint . $frame_id . '?' . $params;
    $genrateurl = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $ipaddress = $_SERVER['REMOTE_ADDR']; // mengambil ipaddress
    $label = $datas['label'];

    $data = [
        'frame_id' => $frame_id, // frame Id sesuaikan pramater reff_cdt = 
        'label' => $label, // prelander,landingpage,fromorder,lead
        'url' => $genrateurl, //untuk mendapatkan url saat ini - PHP , window.location.href - JS
        'ip_address' => $ipaddress
    ];
    $s = request_api('POST', $apiurl, $data);

    $s = json_decode($s);
    // Hasil data ata Resultnya
    if ($s->success == true) :
        $row = $s->data->track;

    else :
        $row = $s->success;
    endif;


    =======================
    AJAX JQ
    =======================
    AJAX 
    Intruksi pemasangan : Silahkan masuk ke File Manager cari file di root website codtech 
    file : codtech.id/js/ nama file 

    function sendJson() {

            let settings = {
                // Sesuaikan url dengan REST API
                "url": "http://localhost/cdtmember/api/sendtracking/" + frameid + "/?key=DAp2GwaOhI",
                "method": "POST",
                "timeout": 0,
                "headers": {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                "data": data
            };

            $.ajax(settings).done(function(response) {
                let row = response.data.track
                console.log(row);
               
                  }

                </pre>

                <div class="row">
                    <h5 class="card-header">Setting di Landingpage </h5>
                </div>
            </div>
        </div>
    </div>
</div>