<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api extends CI_Controller
{
    function __construct()
    {

        parent::__construct();
        set_timezone();
        $this->load->model('api_m');
        $this->load->model('user_m');
    }

    /**
     * METHOD UNTUK SIS ADMIN
     */
    public function index()
    {
        $data['row'] = $this->api_m->get();
        $this->template->load('template', 'apikey/apikey_data', $data);
    }

    public function docs()
    {
        $this->template->load('template', 'apikey/apikey_docs');
    }

    public function add()
    {
        $apikey = new stdClass;
        $apikey->apikey_id = null;
        $apikey->nama = null;
        $apikey->key = null;
        $data = [
            'page' => 'add',
            'row' => $apikey
        ];

        $this->template->load('template', 'apikey/apikey_form', $data);
    }

    public function edit($id)
    {

        $query = $this->api_m->get($id);

        if ($query->num_rows() > 0) {
            $data = [
                'page' => 'edit',
                'row' => $query
            ];
            $data['row'] = $query->row();
            $this->template->load('template', 'apikey/apikey_form', $data);
        } else {
            echo "<script>alert('Data tidak di temuka');
                    window.location = '" . site_url('api') . "'
                </script>";
        }
    }

    public function process()
    {
        $post = $this->input->post(null, TRUE);
        if (isset($_POST['add'])) {
            $this->api_m->add($post);
        } elseif (isset($_POST['edit'])) {
            $this->api_m->edit($post);
        }

        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data berhasil di simpan');
        }
        redirect('api');
    }

    public function del($id)
    {
        $this->api_m->del($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data berhasil di di hapus');
        }
        redirect('api');
    }

    ////////////

    public function sendtracking($id)
    {
        // get frame ID
        // $id = $this->uri->segment(3);
        // $post = $this->input->post_get(null, true);
        $data = [
            'tracking_id' => 'cdt' . date('ymd') . random_string('alnum', 21),
            'label' => $this->input->post_get('label', true),
            'url' => $this->input->post_get('url', true),
            'visit' => 1,
            'ip_address' => $this->input->post_get('ip_address', true),
            'frame_id' => $this->input->post_get('frame_id', true),
            'created_at' => date('Y-m-d')
        ];
        //genrate nama session
        $session_nama = $id;
        $apikey = $this->input->get_post('key', true);
        $key = $this->api_m->key($apikey);
        // tampilkan frame_id
        if ($key->num_rows() > 0) {
            $view = $this->api_m->getdata($id)->row();
            $this->api_m->senddata($data);
            header('Content-Type: application/json');
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Allow-Origin: *');
            header('Set-Cookie: cdt_session=' . $session_nama . '; expires=0; path=/; SameSite=None; HttpOnly');
            echo json_encode([
                'success' => true,
                'message' => 'Data berhail di akses',
                'data' => [
                    'track' => $view
                ]
            ]);
        } else {
            header('Content-Type: application/json');
            echo json_encode([
                'success' => false,
                'message' => 'Data gagal'
            ]);
        }
    }
}
/**
 * ketika user akses api otomatis
 * data di tambah 1 terus tampilkan data per id
 * 
 */
