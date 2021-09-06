<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        set_timezone();
        $this->load->model('produk_m');
        check_not_login();
        check_admin();
    }
    public function index()
    {

        $basepage = 'user/index/'; // url
        $per_page = 10; // masukan baris limit data

        //ambil data search
        if ($this->input->post('search')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = null;
        }

        //configurasi pagination
        $config['total_rows'] = $this->produk_m->countAll($data['keyword']); //ambil count ALl di Model


        $config['per_page'] = $per_page;
        $config['base_url'] = base_url() . $basepage;
        $data['start'] = $this->uri->segment(3);
        $data['total_rows'] = $config['total_rows'];


        //initialize
        $this->pagination->initialize($config);
        $data['row'] = $this->produk_m->getData($config['per_page'], $data['start'], $data['keyword']);


        $this->template->load('template', 'market/produk_data', $data);
    }

    public function add()
    {
        $produk = new stdClass;
        $produk->produk_id = null;
        $produk->nama_produk = null;
        $produk->harga = null;
        $produk->komisi = null;
        $produk->harga_vendor = null;
        $produk->stock = null;
        $produk->level = null;
        $produk->desk = null;
        $produk->gambar = null;
        $data = [
            'page' => 'add',
            'row' => $produk
        ];

        $this->template->load('template', 'market/produk_form', $data);
    }

    public function edit($id)
    {

        $query = $this->produk_m->get($id);

        if ($query->num_rows() > 0) {
            $data = [
                'page' => 'edit',
                'row' => $query
            ];
            $data['row'] = $query->row();
            $this->template->load('template', 'market/produk_form', $data);
        } else {
            echo "<script>alert('Data tidak di temuka');
                    window.location = '" . site_url('produk') . "'
                </script>";
        }
    }

    public function process()
    {
        $post = $this->input->post(null, TRUE);
        if (isset($_POST['add'])) {
            $this->produk_m->add($post);
        } elseif (isset($_POST['edit'])) {
            $this->produk_m->edit($post);
        }

        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data berhasil di simpan');
        }
        redirect('produk');
    }

    public function del($id)
    {
        $this->produk_m->del($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data berhasil di di hapus');
        }
        redirect('produk');
    }
}
