<div class="row">
    <div class="col">
        <div class="card">
            <h5 class="card-header">REST CLIENT</h5>
            <div class="card-body">
                <h5 class="card-title">ENDPOINT API </h5>
                <p>
                    POST <span class="bg-info p-1 text-gray-100">/api/sendtracking/</span>
                </p>
                <p>
                    Kode PHP cURL untuk mengambil API
                </p>
                <pre>
// PAstikan waktu sesuai Timezone
date_default_timezone_set('asia/jakarta');

               // Membuat fungsi cURL
function request_api($method, $endpoint, $data = null)
{

    $resturl = 'http://codtech.local/cdtmember'; // Masukan URL REST Server home tanpa di akhiri '/'
    $urlapi = $resturl . $endpoint;
    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => $urlapi,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_CUSTOMREQUEST => $method,
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

   // Data sisi Client => Pasang di setiap Landing page

$key = [
    'key' => 'DAp2GwaOhI' // Key REST API
];
$frame_id = isset($_GET['reff_cdt']) ? $_GET['reff_cdt'] : null;
$params = http_build_query($key);

$endpoint = '/api/sendtracking/'; // Endpoint Api => /api/sendtracking/
$apiurl = $endpoint . $frame_id . '?' . $params;

$data = [
    'frame_id' => $frame_id, // frame Id sesuaikan pramater reff_cdt = 
    'label' => 'prelander', // prelander,landingpage,fromorder,lead
    'url' => $_SERVER['PHP_SELF'] //untuk mendapatkan url saat ini - PHP , window.location.href - JS
];
$s = request_api('POST', $apiurl, $data);
$s = json_decode($s);

// Hasil data ata Resultnya
if (isset($s)) :
    $row = $s->data->track;
endif;
                </pre>

                <div class="row">
                    <h5 class="card-header">Setting di Landingpage </h5>
                </div>
            </div>
        </div>
    </div>
</div>