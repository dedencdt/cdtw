<?php
defined('BASEPATH') or exit('No direct script access allowed');

//  akses controller adalah -> v1/w
class V1 extends CI_Controller
{
    function __construct()
    {

        parent::__construct();
        set_timezone();
        $this->load->model(['api_m', 'user_m']);
    }

    public function getdataid($id)
    {
        $data = [
            'tracking_id' => 'cdt' . date('ymd') . random_string('alnum', 21),
            'label' => $this->input->post_get('label', true),
            'url' => $this->input->post_get('url', true),
            'visit' => 1,
            'val_conversi' => $this->input->post_get('val_conversi', true),
            'frame_id' => $this->input->post_get('frame_id', true),
            'created_at' => date('Y-m-d')
        ];
        $session_nama = $id;
        $apikey = $this->input->get_post('key', true);
        $key = $this->api_m->key($apikey);
        $mtrack = $this->api_m->getdata()->result();
        $sendata = $this->api_m->senddata($data);

        if ($key->num_rows() > 0) {
            header('Content-Type: application/json');
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Allow-Origin: *');
            header('Set-Cookie: cdt_session=' . $session_nama . '; expires=0; path=/; SameSite=None; HttpOnly');
            echo json_encode([
                'success' => true,
                'message' => 'Data berhail di akses',
                'data' => [
                    'track' => $mtrack
                ]
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Tidak di izinkan akses API'

            ]);
        }
    }
}
